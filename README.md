# StudyBuddy
Group Member :
| No | Full Name                                           | Matric Number |
|----|-----------------------------------------------------|---------------|
| 1  | Nurin Aleya Binti Azhari                            | 2418662       |
| 2  | Nur Irdina Farzana Binti Mohd Rais                 | 2418628       |
| 3  | Nor Farrah Fatihah Binti Mohd. Sopian              | 2412366       |
| 4  | Siti Nur Safiah Binti Nordin                       | 2412974       |
| 5  | Izzatul Husni Izyani Binti Mohd Yusof              | 2410492       |


## Introduction
StudyBuddy is a web-based platform developed to help students collaborate and support each other in their studies. Many students face difficulties in finding study partners, organizing study sessions, and getting help for challenging subjects. This system provides a simple solution by allowing students to create and join study groups based on their courses and learning needs.

The system is developed using the Laravel framework and follows the Model-View-Controller (MVC) architecture. Through the platform, students can create study sessions, upload study materials, submit help requests, communicate with other users, and monitor their learning activities. The system also provides user authentication to ensure that only registered users can access the platform.

The main purpose of StudyBuddy is to encourage collaborative learning, improve academic performance, and create a supportive learning environment among students.


## Objectives
The objectives of the StudyBuddy system are:

To provide a platform for students to create and join study groups easily.
To help students find academic support through help requests and peer responses.
To allow users to share study materials and learning resources with group members.
To improve communication and collaboration among students through study group interactions.
To track study activities using attendance records and session ratings.
To create a more organized and effective learning environment for students.


## Feature & Functionalities
### 1) **Front Page**
<img width="1897" height="825" alt="front page" src="https://github.com/user-attachments/assets/723345f7-5971-4cb7-8ba4-ddc2d95e33a6" />

### Purpose :
### To allow students to access personalized features and join study collaborations
### How it works :
### Users can choose sign up to create new account while login for existing account.

### 2) **Login Page**
<img width="1919" height="819" alt="Screenshot 2026-06-06 104049" src="https://github.com/user-attachments/assets/beb67ddc-10ed-4dfc-b71f-c6cbe91b88df" />

### Purpose :
### - Existing accounts can securely log in into their account
### - Verifies credentials (Student ID/email and password)
### - Able to log in through Google account
### How it works :
### User can choose to insert between registered student ID or email and password to log into website

### 3) **Sign Up Page**
<img width="1581" height="756" alt="Screenshot 2026-06-06 104119" src="https://github.com/user-attachments/assets/27317051-3301-4935-b41e-ea3e9f6969db" />

### Purpose :
### Allow new users to create an account
### Give access to StudyBussy features
### How it works :
### When a user clicks “Sign Up”, users enter their details and the system validates the information. Once verified, the account is created, users are allow to log in and use the system.

### 4) **Learner Dashboard**
<img width="1891" height="697" alt="Screenshot 2026-06-06 110619" src="https://github.com/user-attachments/assets/f6538a6c-6580-486a-93f6-8f9075b0d775" />
<img width="1898" height="327" alt="Screenshot 2026-06-06 110633" src="https://github.com/user-attachments/assets/584aa5af-12f5-4ed6-b992-e479e606f3bd" />

### i) **Dashboard Overview**
### Functionality :
### Displays an overview of the user's study activities which include active groups, joined sessions, help requests and tracked courses.
### Purpose :
### To help users quickly monitor their study progress and activities
### How it works :
### The system retrieves the user’s activity data from the database and displays it on the dashboard

### ii) **Active Group Counter**
### Functionality :
### Shows the number of study groups currently joined by the user
### Purpose :
### To help users track their active participation in study groups
### How it works :
### The system counts and displays all active study groups linked to the user account

### iii) **Joined Session Counter**
### Functionality :
### Displays the total number of study sessions joined by the user
### Purpose :
### To monitor student engagement in collaborative learning
### How it works :
### The system records joined sessions and updates the total automatically

### iv) **Help Request System**
### Functionality :
### Allows users to create and track academic help requests
### Purpose :
### To let students seek help from peers for academic problems
### How it works :
### Users click “Post a New Help Request”, submit details and the request is saved for others to respond

### v) **Study Group Module**
### Functionality :
### Display available study group with subject/course code, location, date&time, group host and number of joined members
### Purpose :
### To help students find and join suitable study sessions
### How it works :
### The system displays available study groups and users can click “Join Group” to participate

### vi) **Join Group Button**
### Functionality :
### Allows users to join available study sessions
### Purpose :
### To encourage peer-to-peer learning and collaboration
### When clicked, the system adds the user to the selected study group and updates participant count

### vii) **Course Search/Filter**
### Functionality :
### Allows users to search for study groups using course codes
### Purpose :
### To quickly find relevant study groups
### How it works :
### Users type a course code and the system filters matching study groups

### viii) **Download Study Materials**
### Functionality:
### Allows users to download learning materials shared in a study group
### Purpose:
### To provide easy access to academic resources
### How it Works:
### Users click the download button, and the system retrieves the uploaded file

### ix) **Group Chat**
### Functionality:
### Allows users to communicate within study groups
### Purpose:
### To support discussion and collaboration among students
### How it Works:
### Users send messages in the group chat and the system updates messages in real time

#### x) **Learner/Host Mode**
### Functionality:
### Allows users to switch between Learner and Host mode
### Purpose:
### To give users flexibility to join or create study sessions
### How it Works:
### Users select a mode and the dashboard adjusts based on the selected role.

### 5) **Post Help Request**
<img width="1867" height="671" alt="Screenshot 2026-06-06 113103" src="https://github.com/user-attachments/assets/aab15dbb-8133-4e05-bd61-4696f5fdc0b5" />

### Functionality :
### - Enter course code and topic title
### - Describe the academic issue or problem
### - Upload optional screenshots or images for reference
### - Submit requests using the Post Request button
### - Cancel the form without saving data
### Purpose :
### Allows students to request academic help from other users andd encourages peer-to-peer learning and collaboration
### How it works :
### Users fill in the help request form and the system validates the input before saving the request into the database. The request is then displayed in the Peer Help Request section where other students can view and respond to it.

### xi) **Dark Mode Interface**
### Functionality:
### Provides a dark-themed interface to improve visibility and user comfort especially in low light environments.
### Purpose:
### To reduce eye strain and improve the user experience during long study sessions
### How it Works:
### Users can switch to Dark Mode using the theme toggle button (sun/moon icon). The system changes the interface colors from light mode to a darker theme while maintaining the same features and functionality

### xii) **Rating Feature**
### Functionality :
### Give ratings based on the study session experience
### Provide optional feedback or comments
### Purpose :
### Allows students to rate study sessions and hosts after participating and helps improve the quality of study groups and user experience
### How it works :
### After a study session is completed, students can submit a rating for the session. The system saves the rating and feedback into the database then updates the overall average rating displayed on the dashboard.


### 6) **Host Dashboard**
<img width="1840" height="761" alt="Screenshot 2026-06-06 113612" src="https://github.com/user-attachments/assets/41389765-e113-4fc6-817d-efe1ab7c5791" />

### Functionalities :
### - Create and host new study groups
### - View hosted sessions and session details
### - Edit, complete or delete study sessions
### - Manage student attendance
### View and respond to peer help requests
### Switch between Learner and Host roles
### Purpose : 
### Allows users to manage and organize study groups and helps hosts monitor sessions, attendance and student requests
### How it works :
### Hosts can create study sessions by entering details such as course, topic, date, time and location. The system saves the session information and displays it on the dashboard. Hosts can then manage attendance, update session status and interact with students through help requests and study group activities

### i) **Create Study Group**
<img width="1871" height="817" alt="Screenshot 2026-06-06 113634" src="https://github.com/user-attachments/assets/0fe41f01-8f27-4386-b6b0-761e226a7b3a" />

### Functionality :
### Enter course code and study topic
### Select campus location, date and time
### Set participant limit for the session
### Upload study materials such as PDFs, documents or images
### Create or cancel the study group setup
### Purpose :
### Allows hosts to create and organize new study sessions and helps students collaborate and join academic discussions
### How it works :
### Hosts fill in the study group details including the course, topic, location, schedule and participant limit. Optional study materials can also be uploaded for participants to access. Once the host clicks the Create Group button, the system validates and saves the session information into the database then displays the new study group on the dashboard for students to join.

### ii) **Take attendance**
<img width="1877" height="813" alt="Screenshot 2026-06-06 113658" src="https://github.com/user-attachments/assets/736a35a4-1ab9-43c4-9253-1281bfdb765d" />

### Functionality :
### View the list of joined students
### Mark students as present or absent using toggle switches
### Save attendance records for each session
### Cancel attendance updates if needed
### Purpose :
### Allows hosts to record and manage student attendance for study sessions and helps track participant participation during study groups
### How It Works :
### Hosts open the attendance section for a study group and view the list of participants. They can mark attendance using the toggle switch and once completed, click the Save Attendance button. The system then saves the attendance records into the database for tracking and future reference.

## MVC Explanation

StudyBuddy is built using the Laravel framework, which follows the Model-View-Controller (MVC) architectural pattern. This pattern separates the application into three interconnected components, making the system easier to develop, maintain, and scale.

### Model
The Model represents the data layer of the application. It handles all database interactions, defines relationships between tables, and enforces business logic related to data. In StudyBuddy, each database table has a corresponding Eloquent Model.
**Key Eloquent Relationships:**
- A `User` **has many** `StudyGroup` (as host), `HelpRequest`, `Reply`, `Rating`, and `GroupChat` records.
- A `StudyGroup` **belongs to** a `User` (host) and **has many** members through `group_user`, and also **has many** `Attendance`, `GroupChat`, and `Rating` records.
- A `HelpRequest` **belongs to** a `User` and **has many** `Reply` records.


### View
The View represents the presentation layer of the application. It is responsible for displaying data to the user and rendering the user interface. In StudyBuddy, Views are built using Laravel Blade templates and are organized by feature.

1. Front Page - The landing page that welcomes users and provides access to Sign Up and Login options. 
2. Login Page - Displays the login form where users enter their Student ID/email and password, with an option to log in via Google. 
3. Sign Up Page - Displays the registration form where new users enter their details to create an account. 
4. Learner Dashboard - The main interface for students, displaying active groups, joined sessions, help requests, available study groups, study materials, and group chat. Includes a course search/filter feature and dark mode toggle.
5. Host Dashboard - The management interface for hosts, showing hosted sessions, participant lists, attendance management, and peer help requests. |
6. Create Study Group Form - A form view for hosts to enter course code, topic, location, date, time, participant limit, and optional study materials. |
7. Post Help Request Form - A form view for students to submit academic help requests including course code, topic, description, and optional image upload. |
8. Take Attendance View - Displays the list of joined students with toggle switches for hosts to mark each student as present or absent. |
9. Rating Form - Displayed after a session is completed, allowing students to submit a star rating and optional feedback. |
10. Group Chat View - Displays the real-time chat history within a study group and allows members to send new messages. |

### Controller
The Controller acts as the intermediary layer between the Model and the View. It handles incoming HTTP requests, processes the logic, interacts with the appropriate Model, and returns the correct View or response. In StudyBuddy, each feature is managed by a dedicated Controller.

1. AuthController - Handles user registration, login credential validation, Google OAuth authentication, and logout. Redirects users to their dashboard upon success. 
2. ProfileController - Manages viewing, updating (name, email, matric number, profile photo), and permanently deleting a user account. 
3. StudyGroupController - Handles creating new study groups with optional material uploads, displaying all groups on the dashboard, editing group details, marking sessions as completed, processing join requests, and deleting sessions. 
4. HelpRequestController - Manages posting, viewing, updating, and deleting academic help requests including optional image file handling. 
5. ReplyController - Handles submitting replies to help requests, updating the response count, and changing the help request status to `in_progress`. 
6. RatingController - Processes star rating and feedback submissions. Uses `updateOrCreate` to either save a new rating or update an existing one for the same user and session. 
7. GroupChatController - Handles sending new chat messages within a study group (restricted to host and joined members) and loading chat history per group. 
8. AttendanceController - Handles bulk saving or updating of student attendance records per study session using matric numbers. Uses `updateOrCreate` to prevent duplicate records. 

**General Request Flow in StudyBuddy:**

User Action (Browser)
       ↓
  Route (web.php)
       ↓
  Controller Method
  ├── Validates Input
  ├── Calls Model (Eloquent)
  │     └── Queries/Updates Database
  └── Returns View or Redirect
       ↓
    View (Blade)
       ↓
  Rendered Response to User

By applying the MVC pattern, StudyBuddy ensures a clear **separation of concerns**, the Model handles data, the View handles display, and the Controller handles logic. This makes the codebase more organized, easier to debug, and more maintainable as the application grows.

## Route Explaination
In the Student Dashboard System, routes are responsible for receiving user requests and directing them to the appropriate controllers. Routes are defined in the web.php file and act as a connection between the user interface and the application logic. Various routes are implemented to support the functionalities provided by the system. Users can access the dashboard, view enrolled courses, monitor attendance records, check grades, view timetables, manage assignments, read announcements, communicate through messages, update their profiles, and modify account settings. Authentication routes are also provided to enable users to log in and log out securely.
The GET method is primarily used to retrieve information from the database and display it to users, whereas the POST, PUT, and DELETE methods are utilized to create, update, and remove records. Through routing, user requests are efficiently managed and directed to the corresponding controllers.

## Controller Explaination
•	DashboardController
The DashboardController manages the main dashboard interface of the StudyBuddy system. It displays the students’ profile card, attendance percentage, upcoming classes, notifications, recent announcement, assignment deadlines and calendar events. This controller provides users with an overview of their academic progress and activities.

•	AnnouncementController
The AnnouncementController is responsible for managing announcements issued by lecturers or administrators. It enables students to stay informed about important updates and academic notices.

•	MessageController
The MessageController facilitates communication between users. It manages the sending, receiving, and retrieval of messages, thereby improving interaction and information sharing.

•	ProfileController
The ProfileController manages student profile information. It enables users to view and update personal details and profile pictures.

•	RatingController
The RatingController manages the feedback and rating mechanism. After participating in study sessions, users can rate their experience and provide comments regarding the quality of assistance received. This feature helps maintain service quality and encourages users to provide constructive feedback.


•	SettingController
The SettingController handles account settings and preferences. It allows users to modify their account information and customize system settings according to their preferences.

## Models Explaination
•	Student model
The student model stores information related to registered students, including student ID, name, email address, password, and profile information. It serves as the central entity of the system and maintains relationships with courses, attendance records, grades, assignments, and messages.

•	Course model
The Course model stores information about enrolled courses, including course codes, course names, and credit hours. It maintains the relationship between students and their respective courses.

•	Grade model
The Grade model stores academic performance data and records the grades obtained by students. 

•	Timetable model
The Timetable model manages scheduling information, including class dates, times, and venues. This model ensures that students can access their class schedules effectively.

•	Assignment model
The Assignment model stores assignment details such as titles, descriptions, due dates, and submission status. It enables students to track pending and completed assignments.

•	Annoucement model
The Announcement model manages important notices and updates issued by lecturers or administrators. It stores announcement titles, contents, and publication dates.

•	Message model
The Message model stores communication records between users. It records message content, sender information, receiver information, and timestamps.

•	Setting model
The Setting model manages user preferences and account configurations, ensuring that students can personalize their experience within the system.

## CRUD Explaination

| Table | Create | Read | Update | Delete | Details |
|-------|:------:|:----:|:------:|:------:|---------|
| `users` | ✅ | ✅ | ✅ | ✅ | Register new account, view profile, update name, email, matric number, and profile photo, delete account |
| `study_groups` | ✅ | ✅ | ✅ | ✅ | Create study group with optional material to upload, view all groups and dashboard stats, update topic, location, date, time, participant limit, and material, mark session as completed, delete group |
| `group_user` | ✅ | ✅ | ❌ | ❌ | Join a study group, view list of joined members, status auto-updates to "full" when participant limit is reached |
| `help_requests` | ✅ | ✅ | ✅ | ✅ | Post a help request with optional image, view all requests, update course, topic, description, status, and image, delete request |
| `replies` | ✅ | ✅ | ❌ | ❌ | Post a reply to a help request, view all replies, auto-increments response count and changes help request status to "in_progress" |
| `ratings` | ✅ | ✅ | ✅ | ❌ | Submit star rating (1–5) with feedback, view ratings per group, re-submitting updates the existing rating (updateOrCreate) |
| `group_chats` | ✅ | ✅ | ❌ | ❌ | Send a message inside a study group (host or joined members only), view full chat history per group |
| `attendances` | ✅ | ✅ | ✅ | ❌ | Mark attendance by student matric number, view attendance records per group, re-submitting updates existing record (updateOrCreate) |

### CRUD Operations by Feature

#### 1. User Authentication & Profile
| Operation | Method | Route | Description |
|-----------|--------|-------|-------------|
| Create | `POST` | `/register` | Register new student account |
| Read | `GET` | `/profile` | View user profile and settings |
| Update | `PUT` | `/profile` | Update name, email, matric number, profile photo |
| Delete | `DELETE` | `/profile` | Delete user account permanently |

#### 2. Study Groups
| Operation | Method | Route | Description |
|-----------|--------|-------|-------------|
| Create | `POST` | `/sessions` | Create new study group with optional material file |
| Read | `GET` | `/dashboard` | View all study groups, my groups and recommended groups |
| Update | `PUT` | `/sessions/{id}` | Edit study group details and replace material file |
| Update | `POST` | `/sessions/{id}/completed` | Mark a study group session as completed |
| Update | `POST` | `/sessions/{id}/join` | Join study group (adds to `group_user` pivot) |
| Delete | `DELETE` | `/sessions/{id}` | Delete study group and its uploaded material |

#### 3. Help Requests
| Operation | Method | Route | Description |
|-----------|--------|-------|-------------|
| Create | `POST` | `/help-requests` | Post new help request with optional image |
| Read | `GET` | `/dashboard` | View all help requests on the dashboard |
| Read | `GET` | `/help-requests/{id}` | View single help request and its replies |
| Update | `PUT` | `/help-requests/{id}` | Edit help request details, image and status |
| Delete | `DELETE` | `/help-requests/{id}` | Delete help request and its image file |

#### 4. Replies
| Operation | Method | Route | Description |
|-----------|--------|-------|-------------|
| Create | `POST` | `/help-requests/{id}/responses` | Post reply to help request |
| Read | `GET` | `/help-requests/{id}` | View all replies under a help request |

#### 5. Ratings
| Operation | Method | Route | Description |
|-----------|--------|-------|-------------|
| Create / Update | `POST` | `/sessions/{id}/rating` | Submit or update star rating and feedback for study group |
| Read | `GET` | `/dashboard` | View all ratings submitted by the current user |

#### 6. Group Chat
| Operation | Method | Route | Description |
|-----------|--------|-------|-------------|
| Create | `POST` | `/sessions/{id}/chat` | Send message in study group chat |
| Read | `GET` | `/dashboard` | View chat messages loaded per study group |

#### 7. Attendance
| Operation | Method | Route | Description |
|-----------|--------|-------|-------------|
| Create / Update | `POST` | `/sessions/{id}/attendance-bulk` | Bulk mark or update attendance by student matric number |
| Read | `GET` | `/dashboard` | View attendance records per study group |




## ERD Diagram
<img width="1406" height="722" alt="Screenshot 2026-06-06 141644" src="https://github.com/user-attachments/assets/37469418-44b3-4425-b721-ac83fbdb7238" />
<img width="1158" height="717" alt="Screenshot 2026-06-06 141702" src="https://github.com/user-attachments/assets/1806b530-4aa5-4e30-aced-ced790464a56" />

### The Entity Relationship Diagram (ERD) represents the database structure of the StudyBuddy and illustrates how the different entities are connected through primary keys and foreign keys. The Users table serves as the central entity in the database as it is linked to several other tables. A user can create multiple study groups through the Study_Groups table which establish a one-to-many relationship where each study group belongs to only one user. In addition, users can join various study groups through the Group_User table which functions as a junction table to implement a many-to-many relationship between users and study groups. This design allows a single user to participate in multiple groups while each group can have multiple members.

### Furthermore, the Study_Groups table is associated with several supporting entities that enhance the functionality of the system. The Attendance table records the attendance status of students for each study session while the Group_Chats table stores messages exchanged within a study group. The Ratings table allows users to provide feedback and rate the study groups they have joined, creating relationships with both the Users and Study_Groups tables. Besides that, the Help_Requests table enables users to submit academic questions or requests for assistance and each request may receive multiple responses stored in the Replies table. Lastly, the Passkeys table is linked to the Users table to manage user authentication credentials.

### Overall, the ERD demonstrates a well-organized relational database structure where the Users and Study_Groups entities form the core of the system. The relationships between the tables ensure efficient management of study groups, member participation, communication, attendance tracking, user authentication, help requests and feedback collection which supporting the overall functionality of the Study Group Management System

## Sequence Diagram
<img width="800" alt="Sequence Diagram - StudyBuddy" 
src="https://github.com/user-attachments/assets/7abaec5a-6592-44d6-99de-15a7c89dfba2" />

The sequence diagram illustrates the full interaction flow of the StudyBuddy web application from user registeration and login, through creating and joining study groups, sending chat messages, posting help requests and submitting ratings.

The StudyBuddy application begins with user authentication.New student register an account by submitting their name, matric number, email and password which gets inserted into the users table. Once registered, the student logs in using their email and password which is verified against the database before being redirected to the dashboard.

After logging in, students can interact with study groups. A host can create a new study group by filling in the course code, topic, location, date , time and participant limit which get stored in the study_groups table. Other students can join the group which inserts a record into the group_user table and increments the joined count. Members who have joined can also send chat messages stored in the group_chats table and the host can mark attendance by updating the attendances table and mark the session as completed by updating the study_groups status.

Students can also use the help request feature for academic support. A student can post a help request with a course code, topic and description which gets inserted into the help_requests table. Other students can reply to the request which inserts a record into the replies table and automatically updates the help request status. Once a study session is completed, students can submit a star rating and feedback which is saved into the ratings table.



## Conclusion
In conclusion, the StudyBuddy system successfully provides a platform that supports collaborative learning among students. The system allows users to create study groups, join study sessions, share learning materials, submit help requests, and communicate with other students in an organized manner.

By using the Laravel MVC architecture, the system is well-structured and easier to manage. The features implemented in the platform help improve student engagement, knowledge sharing, and academic support. Overall, StudyBuddy achieves its objectives of creating a more effective and supportive learning environment for students.


