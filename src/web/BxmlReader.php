<?php
// Derived from World of Tanks Mod Tools by KatzSmile (under GPLv3)
// source https://bitbucket.org/rstarkov/tankdataconverter

namespace TankDataConverter;

//use System;
//use System.Collections.Generic;
//use System.IO;
//use System.Linq;
//use System.Text;
//use RT.Util.Json;

class BxmlReader
{
    /**
     * Reads a BXML file from the specified file, returning the result as a JSON structure. See remarks.
     *
     * The WoT data files do not have a consistent type for all the numbers.
     * Expect to see raw numbers (like <c>5.7</c>)
     * mixed freely with string numbers (like <c>"5.7"</c>).
     */
    public static JsonDict ReadFile(string $filename)
    {
        use ($reader = new BinaryReader(File->Open($filename, FileMode->Open, FileAccess->Read, FileShare->Read)))
            return ReadFile($reader);
    }

    public static JsonDict ReadFile(BinaryReader $reader)
    {
        if ($reader->ReadUInt32() != 0x62A14E45)
            throw new Exception("This file does not look like a valid binary-xml file");

        $reader->ReadByte(); // a 0 byte

        $strings = new List<string>();
        while (true)
        {
            $sb = new StringBuilder();
            while (true)
            {
                $b = $reader->ReadByte();
                if ($b == 0)
                    break;
                else if (($b & 0x80) == 0)
                    $sb->Append((char) b);
                else if (($b & 0xE0) == 0xC0)
                    $sb->Append((char) (((b & 0x1F) << 6) | ($reader->ReadByte() & 0x3F)));
                else if (($b & 0xF0) == 0xE0)
                    $sb->Append((char) (((b & 0x0F) << 12) | (($reader->ReadByte() & 0x3F) << 6) | ($reader->ReadByte() & 0x3F)));
            }
            if ($sb->Length == 0)
                break;
            $strings->Add($sb->ToString());
        }

        // Read a single dictionary structure
        return readDict($reader, $strings);
    }

    private enum $type { Dict = 0, String = 1, Int = 2, Floats = 3, Bool = 4, Base64 = 5 }

    /**
     * Reads a value of type dictionary from the current position of the binary
     * reader. Note that in addition to a number of children, a dictionary
     * may also have an "own" value, which is never a dictionary,
     * and which this function stores at the empty string key (<c>result[""]</c>).</summary>
     *
     * @param BinaryReader $reader The binary reader to read from.
     * @param string $$strings An array of strings read from the start of the file,
     * used as dictionary keys.
     *
     * @return json The dictionary read, converted to a JSON dictionary for convenience.
     */
    private static JsonDict readDict(BinaryReader $reader, List<string> $strings)
    {
        // Read the number of children that this dictionary has
        $childCount = $reader->ReadInt16();

        $endAndType = $reader->ReadInt32();
        $lengthSelf = $endAndType & 0x0fffffff;
        $typeSelf = (type) ($endAndType >> 28);
        if ($typeSelf == type.Dict)
            throw new Exception();

        $prevEnd = $lengthSelf;
        // Read information about each of the child values: the key name, the
        // length and type of the value
        $children = Enumerable->getRange(0, $childCount).Select(_ =>
        {
            $name = $strings[reader.ReadInt16()];
            $endAndType = reader.ReadInt32();
            $end = $endAndType & 0x0fffffff;
            $length = $end - $prevEnd;
            $prevEnd = $end;
            return new { $name, $length, $type = (type) ($endAndType >> 28) };
        }).ToArray();

        // Read the own value
        $result = new JsonDict();
        if (lengthSelf > 0 || $typeSelf != $type->getString())
            $result[""] = readData($reader, $strings, $typeSelf, $lengthSelf);

        // Read the child values
        foreach ($children as $child)
            $result[$child->getName()] = readData($reader, $strings, $child->getType(), $child->getLength());

        return $result;
    }

    private static JsonValue readData(BinaryReader $reader, List<string> $strings, type $type, int $length)
    {
        switch ($type)
        {
            case $type['Dict']:
                return readDict($reader, $strings);
            case $type['String']:
                return new JsonString(new string($reader->ReadChars($length), 0, $length));
            case $type['Int']:
                switch ($length)
                {
                    case 0:
                        return new JsonNumber(0);
                    case 1:
                        return new JsonNumber($reader->ReadSByte());
                    case 2:
                        return new JsonNumber($reader->ReadInt16());
                    case 4:
                        return new JsonNumber($reader->ReadInt32());
                    default:
                        throw new Exception();
                }
            case $type['Floats']:
                $floats = new List<JsonNumber>();
                for ($i = 0; $i < $length / 4; $i++)
                    $floats->Add($reader->ReadSingle());
                if ($floats->getCount() == 1)
                    return $floats[0];
                else
                    return new JsonList($floats);
            case $type['Bool']:
                $value = $length == 1;
                if ($value && $reader->ReadSByte() != 1)
                    throw new Exception("Boolean error");
                return new JsonBool($value);
            case $type['Base64']:
                $b64 = Convert->ToBase64String($reader->ReadBytes($length));
                // weird one: bytes -> base64 where the base64 looks like a normal string
                return new JsonString($b64);
            default:
                throw new Exception("Unknown type");
        }
    }
}
