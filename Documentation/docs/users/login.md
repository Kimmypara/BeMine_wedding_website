# Create login 

User logs into the system using their email address and password.

---

## Request Body

```json
{
    "email": "lolo@mcast.edu.mt",
    "password": "password123"
}
```

---

## Request

<span class="box1">POST</span>
<span class="endpoint-box1">/users/login.php</span>

---

### Body <span class="json">application/json</span>

<span class="box">email</span>
<span class="endpoint-box">string</span>
<span class="endpoint-box">required</span>

Login with same email address when created the account.

<span class="box">password</span>
<span class="endpoint-box">string</span>
<span class="endpoint-box">required</span>

Use same password when created the account.

---

## Responses

### <span class="json">200 OK</span>

Login was successful.

```json
{
    "message": "Login successful.",
    "data": {
        "user_id": 18,
        "first_name": "Kim",
        "last_name": "Para",
        "email": "lolo@mcast.edu.mt",
        "role_id": 2
    }
}
```

---

### <span class="json">400 Bad Request</span>

Email or password is missing.

```json
{
    "message": "Email and password are required."
}
```

---

### <span class="json">401 Unauthorized</span>

Login details are incorrect.

```json
{
    "message": "Invalid email or password."
}
```

---

### <span class="json">403 Forbidden</span>

The account is inactive.

```json
{
    "message": "Your account is inactive."
}
```




