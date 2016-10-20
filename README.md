NVSU Enrollment System
============================

Enrollment system for NVSU with simple reporting. 
* Couse management.


Suggestion : 
      - batch test scheduling
      - scholar application
      - 




REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.




CONFIGURATION
------------
```
DB_DSN=mysql:host=localhost;dbname=yii2basic
DB_USERNAME=root
DB_PASSWORD=
YII_DEBUG=true
YII_ENV=prod
COOKIE_VALIDATION_KEY=
```






tables
---------


educational_attainment
---------
id
education
name_of_school
address_of_school
inclusive_dates_of_attendance


awards_received
---------
id
educational_attainment_id
awards_name

course
---------
id
course_name


student_course
---------
id
student_id
course_id


system_account
---------
id
username
password
authKey
accessToken




NOTES
------------

student_educational_attainment
has many awards_received



awards_receieved
--
id
educational_attainment_id


educational_attainment8


TODO
------------

* Course management for admin
	create table 
		WYSWIG for description
		WYSWIG for course_outline
	create CURUD

*Register User
	include pictures too?

*Manage achievements

*After registration show 
courses page

* Manage Registered student management


* Reports for dashboard panel
	number of male vs female
	map out achievers
	high school from pie cart
	cousrse distribution
	list of valedictorians
	list of salutatorian
	list of varsity students

@TODO - allow user to choose atleast 3 course 
1 preference
2 preference
3 preference


@TODO - order of form field
order should adhere to the form 
given


@TODO - app\commands\InitCoursesController
initialize the courses  , 
insert the courses here


@TODO - app\commands\InitAchievementsController
initialize the achievements  , 
insert the achievements here
