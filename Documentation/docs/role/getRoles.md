# Get Roles 

Get a list of all Roles. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/role/read.php</span>

---

## Description

This endpoint returns all Roles stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "role_id": 1,
            "role_name": "Admin"
        },
        {
            "role_id": 2,
            "role_name": "Couple"
        },
        {
            "role_id": 3,
            "role_name": "Vendor"
        },
        {
            "role_id": 17,
            "role_name": "Wedding Planner"
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No Roles were found.

```json
{
    "message": "Roles not found."
}
```