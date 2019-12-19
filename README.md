# Recruitment task MPC

## Installation

1. Copy repository and packages installation
```shell script
git clone https://github.com/taboritis/mpc-tickets.git
cp .env.example .env
composer install
```

2. Compilling assets
```shell script
npm install && npm run production
```

3. Prepare database
```shell script
mysql -uroot
create database tickets_example;
```

4. Migrate and seed database
```shell script
php artisan migrate:fresh --seed
```
5. Setup cron

Like in Laravel [documentation](https://laravel.com/docs/master/scheduling).

6. Login data

* support member account
    * login: support.member@example.com
    * password: password
* typical user account
    * login: typical.user@example.com
    * password: password
    
## Solutions and assumptions

### Controllers
* Controllers that returns Views are stored at ``app/Http/Controllers``
* Controller operating on Resources are stored in ``app/Http/Controlllers/api``

### Permissions

* Guests (unauthenticated) users can see login and register pages only,
* Each user can see list of Tickets,
* Only SupportMember can see list of Notes
* Ticket Author and SupportMember can see Ticket details, 
* Each User can see list of Users,
* SupportMember can see notes related to Users
* Support Member and Ticket author can see notes related to Ticket

#### With API endopoints
* GET: Each user can get list of tickets
* GET: Ticket author and SupportMember can get ticket with details
* POST: Each user can STORE ticket (SupportMember extends User)
* PUT: SupportMember and Ticker author can update Ticket
* DELETE: Only admin can delete Ticket
* POST: Each user can add note to ticket
* POST: SupportMember only can add note to user

### Assumptions
* Old tasks are defined as task where closet_at date is lesser than 30 days ago (number of days is defined in ``config/tickets.php``),
* *SupportMember* Model extends *User*,
* User has notes visible *only to SupportMember* (in task requirements was *"User has list of Notes that are not visible to Support Member only"*)

### API Endpoints
| Method    | Endpoint                     | Controller Action                                         |
|-----------|-------------------------------|-----------------------------------------------------------|
| GET       | api/tickets                   | App\Http\Controllers\api\TicketsApiController@index       |
| POST      | api/tickets                   | App\Http\Controllers\api\TicketsApiController@store       |
| GET|HEAD  | api/tickets/{ticket}          | App\Http\Controllers\api\TicketsApiController@show        |
| PUT|PATCH | api/tickets/{ticket}          | App\Http\Controllers\api\TicketsApiController@update      |
| DELETE    | api/tickets/{ticket}          | App\Http\Controllers\api\TicketsApiController@destroy     |
| POST      | api/tickets/{ticket}/notes    | App\Http\Controllers\api\CreateNotesApiController@ticket  |
| POST      | api/users/{user}/notes        | App\Http\Controllers\api\CreateNotesApiController@user    |
