-- person (id, name, sex, birthdate, birthplace, deathdate, deathplace);

-- gedcom (id, startingPerson_id);

-- usr (username, pass, gedcom_id);

-- person_spouse (person_id, spouse_id);

-- person_parent (person_id, parent_id);

-- person_child (person_id, child_id);

INSERT INTO person VALUES ('g1i1', 'James Smith','M','10 JAN 1870','USA','18 FEB 1900','USA');

INSERT INTO person VALUES ('g1i2', 'Jane Doe','F','11 AUG 1870','USA','22 AUG 1920','USA');

INSERT INTO person VALUES ('g1i3', 'Robert Doe', 'M', '1 May 1850', 'USA', '1 Nov 1918', 'USA');

INSERT INTO person_spouse VALUES ('g1i1','g1i2');

INSERT INTO person_spouse VALUES ('g1i2','g1i1');

INSERT INTO person_parent VALUES ('g1i2', 'g1i3');

INSERT INTO person_child VALUES ('g1i3', 'g1i2');
