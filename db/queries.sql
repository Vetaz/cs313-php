-- returns spouse of A.id
SELECT B.name
FROM person A
INNER JOIN person_spouse S on S.person_id = A.id 
INNER JOIN person B on s.spouse_id = B.id
WHERE A.id = 'g1i2';

-- returns children of pParent.id
SELECT pChild.name
FROM person pParent
INNER JOIN person_child pc on pc.person_id = pParent.id 
INNER JOIN person pChild on pc.child_id = pChild.id
INNER JOIN person_parent pp ON pp.person_id = pChild.id
WHERE pParent.id = 'g1i3';

-- returns parents of pChild.id
SELECT pParent.name
FROM person pParent
INNER JOIN person_child pc on pc.person_id = pParent.id 
INNER JOIN person pChild on pc.child_id = pChild.id
INNER JOIN person_parent pp ON pp.person_id = pChild.id
WHERE pChild.id = 'g1i2'; 