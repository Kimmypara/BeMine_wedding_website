# Update Account

Update account for the user.

## Request Body

```json
{
    "user_id":"2",
    "email":"kimberly.parascandalo@rocketfins.co",
    "first_name":"Kimmy",
    "last_name": "Parascandalo",
    "password": "123456",
    "is_active":"1"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/users/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">user_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The user_id must be existing. 

<span class="box">email</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The email must be unique and in the correct format. 

<span class="box">first_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

First name of user does not have to be unique but in the correct format.

<span class="box">last_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Last name of user does not have to be unique but in the correct format..

<span class="box">password</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Password of user does not have to be unique.

<span class="box">is_active</span>
<span class="endpoint-box">boolean</span>
<span class="endpoint-box">Required</span>

Determines whether the account is active. Is Active must be:
```
0 = Inactive
1 = Active
```

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so user was updated.

```json
{
    "message": "User updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "User not updated. Missing or invalid input."
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

### <span class="json">404 Not Found</span>

The user_id is not found.

```json
{
    "message": "User ID does not exist."
}
```

---

### <span class="json">409 Conflict</span>

The email address already exists.

```json
{
    "message": "User not updated. E-mail already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the user.

```json
{
    "message": "Server error."
}
``` 