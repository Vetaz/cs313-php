-- lists names of spouses next to each other
SELECT A.name as "Husband's Name", B.name as "Wife's Name"
FROM person A
INNER JOIN person_spouse S on S.person_id = A.id 
INNER JOIN person B on s.spouse_id = B.id
WHERE A.sex = 'M';