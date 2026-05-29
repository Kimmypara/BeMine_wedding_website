# Get Single Role 

Get a single Role by role_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/role/readSingle.php?role_id=1</span>

---

## Description

This endpoint returns a single Role from the database using the provided role_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "role_id": "1",
    "role_name": "Admin"
}
```

---
### <span class="json">400 Bad request</span>

The role_id is missing.

```json
{
    "message": "Missing role_id."
}
```
---
### <span class="json">404 Not Found</span>

No role was found with the provided role_id.

```json
{
    "message": "No roles found."
}
```

### <span class="json">500 Server Error</span>

The server failed to create the Role.

```json
{
    "message": "Server error."
}
``` 