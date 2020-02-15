CREATE TABLE person (
  -- id is g *concat* gedcom file's id #(unique by SERIAL) *concat*
  -- i *concat* gedcom person id # (unique by gedcom software)
  -- ex: g1i1 represents gedcom 1 person 1.
  id VARCHAR(100) NOT NULL UNIQUE PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  sex VARCHAR(10),
  birthdate VARCHAR(100),
  birthplace VARCHAR(100),
  deathdate VARCHAR(100),
  deathplace VARCHAR(100)
);

CREATE TABLE usr (
  username VARCHAR(100) NOT NULL UNIQUE PRIMARY KEY,
  firstName VARCHAR(32) NOT NULL,
  lastName VARCHAR(64) NOT NULL,
  pass VARCHAR(100)
);

CREATE TABLE gedcom (
  id SERIAL NOT NULL PRIMARY KEY,
  -- gedcom only references the starting person rather than all the people 
  startingPerson_id VARCHAR(100) NOT NULL REFERENCES person(id),
  username VARCHAR(100) NOT NULL REFERENCES usr(username)
);

-- many to many, person to person relationships.
-- I could include differnt types of spouses/parents/children.
CREATE TABLE person_spouse (
  person_id VARCHAR(100) NOT NULL REFERENCES person(id),
  spouse_id VARCHAR(100) NOT NULL REFERENCES person(id)
);

CREATE TABLE person_parent (
  person_id VARCHAR(100) NOT NULL REFERENCES person(id),
  parent_id VARCHAR(100) NOT NULL REFERENCES person(id)
);

CREATE TABLE person_child (
  person_id VARCHAR(100) NOT NULL REFERENCES person(id),
  child_id VARCHAR(100) NOT NULL REFERENCES person(id)
);