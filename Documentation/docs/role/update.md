# Update Role  

Update Role. 

## Request Body

```json
{
    "role_id": "1",
    "role_name": "Administrator"
}
```

## Request 

<span class="box1">PUT</span>
<span class="endpoint-box1">/role/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">role_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The role_id must be existing.  

<span class="box">role_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The role name must be unique. 


---

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so Role was updated.

```json
{
    "message": "Role updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Role not updated. Missing or invalid input."
}
```

---

### <span class="json">401 Unauthorized</span>

Unauthorized.

```json
{
    "message": "Unauthorized."
}
```

---

### <span class="json">403 Forbidden</span>

Only administrators can update roles.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">409 Conflict</span>

The role already exists.

```json
{
    "message": "Role not updated. Role already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the Role.

```json
{
    "message": "Server error."
}
``` 