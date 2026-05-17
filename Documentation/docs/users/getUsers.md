# Get Users

Get a list of all users. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/users/read.php</span>

---

## Description

This endpoint returns all users stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "user_id": 1,
            "email": "kim@mcast.edu.mt",
            "first_name": "Kim",
            "last_name": "Para",
            "role_id": 2,
            "is_active": 1
        },
        {
            "user_id": 2,
            "email": "test@gmail.com",
            "first_name": "John",
            "last_name": "Smith",
            "role_id": 3,
            "is_active": 1
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No users were found.

```json
{
    "message": "Users not found."
}
```