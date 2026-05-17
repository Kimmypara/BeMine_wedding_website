# Get Single User

Get a single user by user_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/users/readSingle.php?user_id=3</span>

---

## Description

This endpoint returns a single user from the database using the provided user_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "user_id": 3,
    "email": "kimberly@mcast.edu.mt",
    "first_name": "Kim",
    "last_name": "Para",
    "created_at": "2026-03-30 20:06:54",
    "role_id": 3,
    "is_active": 1
}
```

---
### <span class="json">400 Bad request</span>

The user_id is missing.

```json
{
    "message": "Missing User Id."
}
```
---
### <span class="json">404 Not Found</span>

No user was found with the provided user_id.

```json
{
    "message": "User not found."
}
```