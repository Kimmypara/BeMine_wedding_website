# Create Role

Create a new Role.  

## Request Body

```json
{
    "role_name": "Wedding Planner"
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/role/create.php</span>

### Body <span class="json">application/json</span>


<span class="box">role_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The role name must be unique. 


## Responses

### <span class="json">201 Created</span>

The request worked, so a new Role was created.

```json
{
    "message": "Role created."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Role not created. Missing or invalid input."
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

Only administrators can create roles.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">409 Conflict</span>

The Role already exists.

```json
{
    "message": "Role not created. Role already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to create the Role.

```json
{
    "message": "Server error."
}
``` 