-- drop table note;
-- drop table person;
-- drop table speaker;
-- drop table conference;
-- drop table talk;


CREATE TABLE person (
    id SERIAL NOT NULL PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    display_name VARCHAR(100) NOT NULL
);

CREATE TABLE speaker (
    id SERIAL NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE conference (
    id SERIAL NOT NULL PRIMARY KEY,
    year INT NOT NULL,
    month INT NOT NULL
);

CREATE TABLE talk (
    id SERIAL NOT NULL PRIMARY KEY,
    speaker_id INT REFERENCES speaker(id),
    conference_id INT REFERENCES conference(id) 
);


CREATE TABLE note (
    id SERIAL NOT NULL PRIMARY KEY,
    note_content TEXT NOT NULL,
    person_id INT NOT NULL REFERENCES person(id), 
    talk_id INT REFERENCES talk(id) 
 );
