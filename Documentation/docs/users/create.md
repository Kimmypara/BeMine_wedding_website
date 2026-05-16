# Create Account

Create a new account for the user. Couple can have one shared account by using the same mail address to login. 

## Request Body

```json
{
    "email": "lolo@mcast.edu.mt",
    "first_name":"Kim",
    "last_name": "Para",
    "password": "password123",
    "is_active":"1"
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/users/create.php</span>

### Body <span class="json">application/json</span>

<span class="box">email</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Email address, for example "emailaddress@gmail.com". The e-mail must be unique.

<span class="box">first name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

First name of user does not have to be unique. 

<span class="box">last name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Last name of user does not have to be unique.

<span class="box">password</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Password of user does not have to be unique.

<span class="box">is active</span>
<span class="endpoint-box">boolean</span>
<span class="endpoint-box">Required</span>

Determines whether the account is active. Is Active must be:
```
0 = Inactive
1 = Active
```

## Responses

### <span class="json">201 Created</span>

The request worked, so a new user was created.

```json
{
    "message": "User created."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "User not created. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "Invalid email format."
}
```

```json
{
    "message": "Invalid user name."
}
```

```json
{
    "message": "Invalid user surname."
}
```

```json
{
    "message": "Invalid Is Active value. Use 0 or 1 only."
}
```

---

### <span class="json">409 Conflict</span>

The email address already exists.

```json
{
    "message": "User not created. E-mail already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to create the user.

```json
{
    "message": "Server error."
}
``` 