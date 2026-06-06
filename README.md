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










## Objectives




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


## MVC Explaination







## Route Explaination








## Controller Explaination







## Models Explaination






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









## ERD Diagram
<img width="1406" height="722" alt="Screenshot 2026-06-06 141644" src="https://github.com/user-attachments/assets/37469418-44b3-4425-b721-ac83fbdb7238" />
<img width="1158" height="717" alt="Screenshot 2026-06-06 141702" src="https://github.com/user-attachments/assets/1806b530-4aa5-4e30-aced-ced790464a56" />

### The Entity Relationship Diagram (ERD) represents the database structure of the StudyBuddy and illustrates how the different entities are connected through primary keys and foreign keys. The Users table serves as the central entity in the database as it is linked to several other tables. A user can create multiple study groups through the Study_Groups table which establish a one-to-many relationship where each study group belongs to only one user. In addition, users can join various study groups through the Group_User table which functions as a junction table to implement a many-to-many relationship between users and study groups. This design allows a single user to participate in multiple groups while each group can have multiple members.

### Furthermore, the Study_Groups table is associated with several supporting entities that enhance the functionality of the system. The Attendance table records the attendance status of students for each study session while the Group_Chats table stores messages exchanged within a study group. The Ratings table allows users to provide feedback and rate the study groups they have joined, creating relationships with both the Users and Study_Groups tables. Besides that, the Help_Requests table enables users to submit academic questions or requests for assistance and each request may receive multiple responses stored in the Replies table. Lastly, the Passkeys table is linked to the Users table to manage user authentication credentials.

### Overall, the ERD demonstrates a well-organized relational database structure where the Users and Study_Groups entities form the core of the system. The relationships between the tables ensure efficient management of study groups, member participation, communication, attendance tracking, user authentication, help requests and feedback collection which supporting the overall functionality of the Study Group Management System

## Sequence Diagram
<img width="800" alt="Sequence Diagram - StudyBuddy" 
src="https://github.com/user-attachments/assets/7abaec5a-6592-44d6-99de-15a7c89dfba2" />

### The sequence diagram illustrates the full interaction flow of the StudyBuddy web application from user registeration and login, through creating and joining study groups, sending chat messages, posting help requests and submitting ratings.

### The StudyBuddy application begins with user authentication.New student register an account by submitting their name, matric number, email and password which gets inserted into the users table. Once registered, the student logs in using their email and password which is verified against the database before being redirected to the dashboard.

### After logging in, students can interact with study groups. A host can create a new study group by filling in the course code, topic, location, date , time and participant limit which get stored in the study_groups table. Other students can join the group which inserts a record into the group_user table and increments the joined count. Members who have joined can also send chat messages stored in the group_chats table and the host can mark attendance by updating the attendances table and mark the session as completed by updating the study_groups status.

### Students can also use the help request feature for academic support. A student can post a help request with a course code, topic and description which gets inserted into the help_requests table. Other students can reply to the request which inserts a record into the replies table and automatically updates the help request status. Once a study session is completed, students can submit a star rating and feedback which is saved into the ratings table.



## Conclusion



