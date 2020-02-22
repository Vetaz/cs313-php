-- returns spouse of p.id
SELECT s.name AS "spouse"
FROM person p
INNER JOIN person_spouse on person_spouse.person_id = p.id
INNER JOIN person s on person_spouse.spouse_id = s.id
INNER JOIN gedcom ON gedcom.id = person_spouse.gedcom_id and gedcom.id = p.gedcom_id and gedcom.id = s.gedcom_id
WHERE gedcom.id = '8' and p.id = '2';

-- returns children of pParent.id
SELECT pChild.name AS "child"
FROM person pChild
INNER JOIN person_child on person_child.child_id = pchild.id
INNER JOIN person pParent on person_child.person_id = pParent.id
INNER JOIN gedcom ON gedcom.id = person_child.gedcom_id and gedcom.id = pChild.gedcom_id and gedcom.id = pParent.gedcom_id
WHERE gedcom.id = '8' and pParent.id = '2';

-- returns parents of pChild.id
SELECT pParent.name AS "parent"
FROM person pParent
INNER JOIN person_parent on person_parent.parent_id = pParent.id
INNER JOIN person pChild on person_parent.person_id = pChild.id
INNER JOIN gedcom ON gedcom.id = person_parent.gedcom_id and gedcom.id = pChild.gedcom_id and gedcom.id = pParent.gedcom_id
WHERE gedcom.id = '8' and pChild.id = '2';



INSERT INTO person (id, gedcom_id, name, sex, birthdate, birthplace, deathdate, deathplace) VALUES ('I1', 1, 'Jordi Kloosterboer', 'M', '1996', 'Neth', '','');

INSERT INTO person (id, gedcom_id, name, sex, birthdate, birthplace, deathdate, deathplace) VALUES ('I2', 1, 'female Kloosterboer', 'F', '2000', 'USA', '','');

-- Selects all people's ids from all gedcoms from the user named U.
select person.id from person inner join gedcom on person.gedcom_id = gedcom.id inner join usr on usr.username = gedcom.username where usr.username = 'U';