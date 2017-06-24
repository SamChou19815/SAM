SAM
====
System of Assignment Management


The structure of the code
-------------------------
1.  files/
    - All the static resources needed
2.  framework/
    - All the frameworks that are either from prominent developers or files I used in other projects.
    1.  fix/
        - Fix the stupid data input of safari
    2.  geodesic/
        - Sam's UI Framework
    3.  googlefont/
        - Static Google Fonts file
    4.  js/
        - Javascript frameworks
        1.  form.js
            - jQuery form
        2.  jq.js
            - jQuery framework
    5.  pure/
        - UI framework from Yahoo with some modification from Sam
3.  modules/
    - All the php files used to process ajax requests
    - Some folders have a 'ManipulateXXXClass.php', which shall contain all the process functions and their documents.
    1.  assignments/
        - Used to deal with the request related to assignments
        1.  ManipulateAssignmentClass.php
            - Check the document in file
            - **It behaves differently on local development and SAE**
        2.  UnitAssignment.php
            - A class created mainly for JSON object construction
        3.  addAssignment.php
            - Used to add a new assignment
        4.  classLoadAssignment.php
            - Used to load assignments for a class
        5.  studentLoadAssignment.php
            - Used to load assignments for a student
        6.  markCompletion.php
            - Used to mark an assignment as completed
        7.  markUnCompletion.php
            - Used to mark an assignment as uncompleted
        8.  updateAssignment.php
            - Used to update the content of an assignment
        9.  deleteAssignment.php
            - Used to delete an assignment
    2.  class/
        - Used to deal with the request related to classes
        1.  ManipulateClassClass.php
            - Check the document in file
        2.  UnitClass.php
            - A class created mainly for JSON object construction
        3.  createClass.php
            - Used to create a class
        4.  deleteClass.php
            - Used to delete a class
        5.  changeClassMembers.php
            - Used by admin to change class members of a class
        6.  loadClassMembers.php
            - Used to load class members of a class
        7.  loadClass.php
            - Used to load class for students or teachers
    3.  client/
        - It is used for client on iOS and Android
        1.  classes/
            - Classes for calling
            1.  checkID.php
                - Check the validity of user on the client side
            2.  Device.php
                - A class for a device. Programmers can:
                    - Update its info
                    - Push notification
                - **It behaves differently on local development and SAE**
            3.  updateToken.php
                - Update token for pushing notification
        2.  v1/assignment/
            - Deprecated
            - DON'T USE
            - Used by Client V1
            1.  getNotification.php
            2.  updateNotificationRaw.php
    4.  common/
        - Common functions that is essential to a server side framework
        1.  basic.php
            - It contains function to process basic operations
        2.  crypto.php
            - It is used to encrypt/decrypt/hash strings
        3.  downloader.php
            - Once visited with appropriate parameters, it will download the designated file.
            - **It behaves differently on local development and SAE**
    5.  database/
        - It is used to deal with the database
        1.  connect.php
            - Used to connect to database
            - **It behaves differently on local development and SAE**
    6.  security/
        - Used to enhance the security of the system
        - Used to find the cracker when the system is compromised
        1.  loadIPAddress.php
            - It loads all the IPs that once appeared in the system
        2.  Security.php
            - It is a class that provides bridge to database for security
    7.  test/
        - Used to test
        1.  test.php
            - only file used to test functions
    8.  user/
        - Used to deal with the request related to users
        1.  User.php
            - A user class that provides function to update its info
        2.  UserInfo.php
            - A class created mainly for JSON object construction
        3.  checkValid.php
            - Used to check the identity of a user
        4.  ManipulateUserClass.php
            - Check the document in file
            - **It behaves differently on local development and SAE**
        5.  create.php
            - Used to create a single user
        6.  massiveCreateUser.php
            - Used to create users for a class
        7.  listUserInfo.php
            - Used to list all the user info
        8.  listUserWithDefaultPassword.php
            - Used to list all the user info of whom has default password
        9.  forgotPasswordSendMail.php
            - Used to send mail to those who forgot password
        10.  forgotPassword.php
            - Used to respond to the reset password command
        11.  changeEmail.php
            - Used to change email
        12.  changePassword.php
            - Used to changePassword
4.  template/
    - Template that would be requested
    1.  pages/
        - Store the pages that would be repeatedly used in apps
        1.  settings.html
            - Settings page
    2.  scripts/
        1.  assignment.js
            - Deal with assignments
        2.  base.js
            - Deal with basic level functions used
        3.  class.js
            - Deal with class
        4.  settings.js
            - Deal with settings
        5.  waterfall.js
            - The waterfall UI in the stream view of student side
    3.  sources/
        - Not used yet
5.  admin.php
    - The admin side
6.  student.php
    - The student side
7.  teacher.php
    - The teacher side
8.  config.php
    - Configuration. It includes:
        - App Name
        - Mode of the app (local development or SAE)
9.  login.php
    - Used to display login page and process login request
10.  index.php
    - Automatically loads student.php or teacher.php for different type of users


