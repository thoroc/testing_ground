
SELECT s0_.id AS id0,
s0_.Subject AS Subject1,
s0_.fsatexported AS fsatexported2,
s0_.ClosedDate AS ClosedDate3,
s0_.Team__c AS Team__c4,
s1_.Name AS Name5,
s0_.Service_Type__c AS Service_Type__c6,
s0_.Origin AS Origin7,
s0_.Country__c AS Country__c8,
s0_.Translation_Case__c AS Translation_Case__c9,
s0_.Case_Language__c AS Case_Language__c10,
s0_.Architecture__c AS Architecture__c11,
s0_.Technology__c AS Technology__c12,
s1_.Theatre__c AS Theatre__c13,
s1_.Sub_Theatre__c AS Sub_Theatre__c14,
s2_.Name AS Name15,
s0_.Contact_Email__c AS Contact_Email__c16
FROM salesforce__case s0_
INNER JOIN salesforce__user s1_ ON (s0_.owner_id = s1_.id)
INNER JOIN salesforce__contact s2_ ON (s0_.contact_id = s2_.id)
WHERE (s0_.ClosedDate BETWEEN '2013-07-10 00:00:00' AND '2013-07-17 23:59:59')
AND s0_.IsClosed = 1
AND s0_.Status_Reason__c = 'Resolved SuccessFully'
AND s0_.parent_id IS NULL
AND (s0_.fsatexported IS NULL OR s0_.fsatexported = 0)
AND s0_.Partner = 1
AND ( s0_.City_State_Province_Zip_Postal_Code__c LIKE '%,QC,%' OR s0_.City_State_Province_Zip_Postal_Code__c LIKE '%Quebec%')
ORDER BY s0_.ClosedDate ASC

-- PH quebec
SELECT c.id, c.fsatexported, c.ClosedDate
FROM  `salesforce__case` c
WHERE ( c.fsatexported = 0 OR c.fsatexported IS NULL )
AND c.ClosedDate BETWEEN '2013-07-17 00:00:00' AND  '2013-07-24 23:59:59'
AND c.Status_Reason__c = 'Resolved SuccessFully'
AND c.IsClosed = '1'
AND c.Partner  = '1'
AND ( c.City_State_Province_Zip_Postal_Code__c LIKE '%,QC,%'
OR c.City_State_Province_Zip_Postal_Code__c LIKE '%Quebec%' )

-- PH non quebec
SELECT c.id, c.fsatexported, c.ClosedDate
FROM  `salesforce__case` c
WHERE ( c.fsatexported = 0 OR c.fsatexported IS NULL )
AND c.ClosedDate BETWEEN '2013-07-17 00:00:00' AND  '2013-07-24 23:59:59'
AND c.Status_Reason__c = 'Resolved SuccessFully'
AND c.IsClosed = '1'
AND c.Partner  = '1'
AND c.City_State_Province_Zip_Postal_Code__c NOT LIKE '%,QC,%'
AND c.City_State_Province_Zip_Postal_Code__c NOT LIKE '%Quebec%'

-- TSN
SELECT c.id, c.fsatexported, c.ClosedDate
FROM  `salesforce__case` c
INNER JOIN `salesforce__user` u ON (c.case_requester_id = u.id)
WHERE u.employee_id IS NULL
AND ( c.fsatexported = 0 OR c.fsatexported IS NULL )
AND c.ClosedDate BETWEEN '2013-04-02 00:00:00' AND  '2013-04-09 23:59:59'
AND c.Status_Reason__c = 'Resolved SuccessFully'
AND c.Service_type__c != 'dCloud Virtual'
AND c.IsClosed = '1'
AND c.Partner  = '0'
