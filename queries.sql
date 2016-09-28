#однокурсников со средним баллом от .. до .., и именем %name%
SELECT 
	AVG(rates.rate) AS average,
	students.name AS name,
	students.surname AS surname
FROM students
	LEFT JOIN rates ON (students.id = rates.student_id)
WHERE students.name = %name%
GROUP BY rates.part
HAVING average BETWEEN ... AND ...


#всех   людей,   c   IP   которых   произошло   более   одной   регистрации,   и   при   этом   хотя   бы  
#у одного из них должна быть написана характеристика научного руководителя
SELECT * 
FROM students 
WHERE students.ip in (
	SELECT students.ip 
	FROM students GROUP BY students.ip HAVING COUNT(*) > 1) 
AND students.comment IS NOT NULL