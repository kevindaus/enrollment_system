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


student_information
-------
id

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







TODO
------------


@TOOD - make this filter work
http://localhost:8080/enrollee

@TODO - fix
http://localhost:8080/dashboard
course distribution


@TODO - view all student in a table
* Manage Registered student management
@DONE
View student
@DONE

Delete Student
@DONE


@ONGOING
Update Student
@DONE

@TODO
cousrse distribution
@DONE


@TODo - autocomplete for educational attainment
name of school
@DONE



* Reports for dashboard panel
	number of male vs female
	@DONE

	map out achievers
		list of valedictorians
		@DONE
		list of salutatorian
		@DONE
		list of varsity students
		@DONE



@TODO - allow user to choose atleast 3 course 
1 preference
2 preference
3 preference
@DONE




@TODO - initialize 
awards recevied
@DONE



@todo - initialize courses
@DONE



@TODO - 
chck this out 
SELECT * FROM `educational_attainment`
bug not saving other fields/columns
@DONE




* After registration show 
success message only
@DONE





@TODO - order of form field
order should adhere to the form 
given
@DONE


@TODO - app\commands\InitCoursesController
initialize the courses  , 
insert the courses here
@DONE


@TODO - app\commands\InitAchievementsController
initialize the achievements  , 
insert the achievements here
@DONE

@ADDON
*Register User
	include camera picture
	include signature panel at the bottom


