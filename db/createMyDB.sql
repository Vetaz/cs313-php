CREATE TABLE usr (
  username VARCHAR(100) NOT NULL UNIQUE PRIMARY KEY,
  firstName VARCHAR(32) NOT NULL,
  lastName VARCHAR(64) NOT NULL,
  pass VARCHAR(100) NOT NULL
);

CREATE TABLE gedcom (
  id SERIAL NOT NULL PRIMARY KEY,
  username VARCHAR(100) NOT NULL REFERENCES usr(username) ON DELETE CASCADE
  -- When usr is deleted, their gedcom is deleted.
);

CREATE TABLE person (
  id INT NOT NULL,
  gedcom_id INT NOT NULL REFERENCES gedcom(id) ON DELETE CASCADE,
  -- When gedcom is deleted, the people in it are deleted.
  name VARCHAR(100) NOT NULL,
  sex VARCHAR(10),
  birthdate VARCHAR(100),
  birthplace VARCHAR(100),
  deathdate VARCHAR(100),
  deathplace VARCHAR(100),
  PRIMARY KEY (gedcom_id,id)
);

-- many to many, person to person relationships.
-- I could include differnt types of spouses/parents/children.
CREATE TABLE person_spouse (
  gedcom_id INT,
  person_id VARCHAR(100),
  spouse_id VARCHAR(100),
  FOREIGN KEY (gedcom_id, person_id) REFERENCES person(gedcom_id,id) ON DELETE CASCADE,
  FOREIGN KEY (gedcom_id, spouse_id) REFERENCES person(gedcom_id,id) ON DELETE CASCADE
  -- When the people are deleted, their relationship is deleted.
);

CREATE TABLE person_parent (
  gedcom_id INT,
  person_id VARCHAR(100),
  parent_id VARCHAR(100),
  FOREIGN KEY (gedcom_id, person_id) REFERENCES person(gedcom_id,id) ON DELETE CASCADE,
  FOREIGN KEY (gedcom_id, parent_id) REFERENCES person(gedcom_id,id) ON DELETE CASCADE
  -- When the people are deleted, their relationship is deleted.
);

CREATE TABLE person_child (
  gedcom_id INT,
  person_id VARCHAR(100),
  child_id VARCHAR(100),
  FOREIGN KEY (gedcom_id, person_id) REFERENCES person(gedcom_id,id) ON DELETE CASCADE,
  FOREIGN KEY (gedcom_id, child_id) REFERENCES person(gedcom_id,id) ON DELETE CASCADE
  -- When the people are deleted, their relationship is deleted.
);