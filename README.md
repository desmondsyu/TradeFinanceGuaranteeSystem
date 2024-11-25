## Trade Finance Guarantee Issuance System
The application uses Laravel. focusing on core CRUD operations for guarantees, including creating, reviewing, applying for, issuing, and deleting guarantees. The system supports different types of guarantees: Bank, Bid Bond, Insurance, and Surety.<br> Additionally, the system supports two methods of guarantee processing: manual entry and data transfer via bulk uploads of CSV, JSON, or XML files. Uploaded files will be stored as blobs in the database, with functionality to list and delete these files. The application uses Laravel’s Auth middleware for secure access, Blade templates for all views, and Eloquent ORM for database operations.

## How to Run
Clone the project, them deploy it with podman command: 'podman-compose up -d'<br>
Use http://localhost:8000/ to visit the system.

## Members
<table>
<tr>
 <th>Name</th>
 <th>Number</th>
</tr>
<tr>
 <td>Marina Medeiros Carvalho</td>
  <td>n01606437</td>
</tr>
 <tr>
 <td>Vitaly Sukhinin</td>
  <td>n01605938</td>
</tr>
 <tr>
 <td>Kexin Zhu</td>
  <td>n01621302</td>
</tr>
</table>
