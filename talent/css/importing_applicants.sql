receipts for project information

INSERT INTO basket (c_email,company_reg,added_by,receipt_id,status)
SELECT  distinct md5(p.email),r.company_reg,r.added_by,r.receipt_id,"de219898d3004daea907e99dbc683e02"
FROM programme_interest p
inner join candidate_tbl c on c.c_email = p.email
inner join receipts r on r.name = "Graduate Recruitment"
where p.interest = "Graduate Recruitment"
and c.c_verified = "verified"
and md5(p.email) not in (SELECT c_email from basket where receipt_id = r.receipt_id)


SELECT DISTINCT email FROM `programme_interest`
 WHERE interest = "Graduate Recruitment" 
 and email in (select c_email from candidate_tbl where verified ='verified');


