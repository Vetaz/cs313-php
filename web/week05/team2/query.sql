\echo '2a. How many events are there?'

SELECT COUNT(*) FROM w5_event;

\echo '2b. How many participants are there?'
SELECT COUNT(*) FROM w5_participant;

\echo '3a. What is the third event when sorted alphabetically (by name)? '

SELECT name FROM w5_event ORDER BY name LIMIT 1 OFFSET 2;

\echo '3b. What is the third event when sorted by ID? '
SELECT name FROM w5_event ORDER BY id LIMIT 1 OFFSET 2;

\echo '4a. List the names alphabetically of all the participants in the ''Toughman Utah'' competition'
SELECT p.name 
FROM w5_participant AS p 
INNER JOIN w5_event_participant as ep ON ep.participant_id = p.id
INNER JOIN w5_event AS e ON ep.event_id = e.id
WHERE e.name = 'Toughman Utah'
ORDER BY p.name;

\echo '4b. List the names (sorted by id) of all the participants in the ''Kauai Marathon'' competition'
SELECT p.id as ID, p.name AS Name 
FROM w5_participant AS p 
INNER JOIN w5_event_participant as ep ON ep.participant_id = p.id
INNER JOIN w5_event AS e ON ep.event_id = e.id
WHERE e.name = 'Kauai Marathon'
ORDER BY p.id;

\echo '5a. How many competitions has ''Black Panther'' competed in?'
SELECT COUNT(*) 
FROM 
(SELECT p.name 
FROM w5_participant AS p 
INNER JOIN w5_event_participant as ep ON ep.participant_id = p.id
INNER JOIN w5_event AS e ON ep.event_id = e.id
WHERE p.name = 'Black Panther') AS bp_events;


\echo '5b. How can you verify that your count is correct?'  
(SELECT e.name as Event, p.name as Name  
FROM w5_participant AS p 
INNER JOIN w5_event_participant as ep ON ep.participant_id = p.id
INNER JOIN w5_event AS e ON ep.event_id = e.id
WHERE p.name = 'Black Panther');

\echo '5c. Who has competed in the most competitions? How many have they competed in?'
SELECT p.name as Name, COUNT(e.id) AS Count 
FROM  w5_participant AS p 
INNER JOIN w5_event_participant as ep ON ep.participant_id = p.id
INNER JOIN w5_event AS e ON ep.event_id = e.id 
GROUP BY p.name
ORDER BY count DESC
LIMIT 1;

\echo '5d. Who has competed in the least competitions? How many have they competed in?'


\echo '5d. people who have competed in 1 or more'
SELECT p.name as Name, COUNT(e.id) AS Count 
FROM  w5_participant AS p 
INNER JOIN w5_event_participant as ep ON ep.participant_id = p.id
INNER JOIN w5_event AS e ON ep.event_id = e.id 
GROUP BY p.name
ORDER BY count
LIMIT 1;

\echo '5d. - people that didn''t compete in any'
SELECT p.name as Name, COUNT(e.id) AS Count 
FROM  w5_participant AS p 
LEFT JOIN w5_event_participant as ep ON ep.participant_id = p.id
LEFT JOIN w5_event AS e ON ep.event_id = e.id 
GROUP BY p.name
ORDER BY Count;

-- \echo '6a. Is there anyone who has competed in the same competition twice? '
---------------- Your code here ----------------

-- \echo '6b. Which event had the most competitors? '
---------------- Your code here ----------------

-- \echo '6c. Which event had the least competitors? '
---------------- Your code here ----------------

-- \echo '6d. List all competitors that competed in the same event at least once '
---------------- Your code here ----------------
