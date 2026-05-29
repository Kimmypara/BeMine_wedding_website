# Update Guest Email

Update the Guest Email.

## Request Body

```json
{
    "guest_id":"1",
    "guest_email":"kimberly@gmail.com"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/guest/updateGuestEmail.php</span>

### Body <span class="json">application/json</span>

<span class="box">guest_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The guest_id must be existing.  

<span class="box">guest_email</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The guest_email must be unique.

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so Guest Email was updated.

```json
{
    "message": "Guest updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Guest not updated. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "Invalid email format."
}
```
---

### <span class="json">409 Conflict</span>

The Guest email already exists.

```json
{
    "message": "Guest not updated. E-mail already exists."
}
```

Possible validation errors:

```json
{
    "message": "Guest email not updated sine Guest Id does not exists."
}
```
---

### <span class="json">500 Server Error</span>

The server failed to update the Guest Email.

```json
{
    "message": "Server error."
}
``` 