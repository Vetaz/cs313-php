-- returns children id of pParent.id
SELECT pChild.id AS "childId"
FROM person pChild
INNER JOIN person_child on person_child.child_id = pchild.id
INNER JOIN person pParent on person_child.person_id = pParent.id
INNER JOIN gedcom ON gedcom.id = person_child.gedcom_id and gedcom.id = pChild.gedcom_id and gedcom.id = pParent.gedcom_id
WHERE gedcom.id = '$gedcomId' and pParent.id = '$startingId';

-- returns spouses of p.id
SELECT s.id AS \"spouseId\"
FROM person p
INNER JOIN person_spouse on person_spouse.person_id = p.id
INNER JOIN person s on person_spouse.spouse_id = s.id
INNER JOIN gedcom ON gedcom.id = person_spouse.gedcom_id and gedcom.id = p.gedcom_id and gedcom.id = s.gedcom_id
WHERE gedcom.id = '$gedcomId' and p.id = '$startingId';

-- returns parents of pChild.id
SELECT pParent.id AS "parentId"
FROM person pParent
INNER JOIN person_parent on person_parent.parent_id = pParent.id
INNER JOIN person pChild on person_parent.person_id = pChild.id
INNER JOIN gedcom ON gedcom.id = person_parent.gedcom_id and gedcom.id = pChild.gedcom_id and gedcom.id = pParent.gedcom_id
WHERE gedcom.id = '$gedcomId' and pChild.id = '$startingId';

-- gets specific data from each person so user can select them
SELECT id, name, birthdate 
FROM person 
WHERE gedcom_id = '$gedcom_id' 
ORDER BY id;

-- gets gedcom id for a specific username so user can select one
SELECT id 
FROM gedcom 
WHERE username = '$username' 
ORDER BY id;

-- delete a specific gedcom
DELETE FROM gedcom 
WHERE id = '$gedcom_id';

-- make a new gedcom for a specific username
INSERT INTO gedcom (username) VALUES ('$username');

-- make a new person
INSERT INTO person (gedcom_id, id, name, sex, birthdate, birthplace, deathdate, deathplace) VALUES ('$gedcom_id', '$id', '$name', '$sex', '$birthDate', '$birthPlace', '$deathDate','$deathPlace');

-- make a new parent relationship
INSERT INTO person_parent (gedcom_id, person_id, parent_id) VALUES ('$gedcom_id', '$id', '$parentId');

-- make a new spouse relationship
INSERT INTO person_spouse (gedcom_id, person_id, spouse_id) VALUES ('$gedcom_id', '$id', '$spouseId');

-- make a new child relationship
INSERT INTO person_child (gedcom_id, person_id, child_id) VALUES ('$gedcom_id', '$id', '$childId');

-- get the username and password of a specific username
SELECT username, pass FROM usr WHERE username = '$username';

-- see if specific username is already chosen
SELECT username FROM usr WHERE username = '$desiredUsername';

-- Selects all people's ids from all gedcoms from the user named U.
select person.id from person inner join gedcom on person.gedcom_id = gedcom.id inner join usr on usr.username = gedcom.username where usr.username = 'U';