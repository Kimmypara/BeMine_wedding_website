# Update Guest

Update Guest.

## Request Body

```json
{
    "guest_id":"2",
    "guest_email":"kevinp@gmail.com",
    "guest_name":"Kevin",
    "guest_surname":"Borg",
    "rsvp_status":"pending"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/guest/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">guest_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The guest_id must be existing. 

<span class="box">guest_email</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The guest_email must be unique.

<span class="box">guest_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Guest name does not have to be unique. 

<span class="box">guest_surname</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Guest surname does not have to be unique. 

<span class="box">rsvp_status</span>
<span class="endpoint-box">ENUM</span>
<span class="endpoint-box">Required</span>

Chice between pending, accepted or declined. Pending is the default option. 

<span class="box">guest_category</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Choice between guest categories such as:
- Family of the Bride
- Family of the Groom
- Friends
- Work Friends
- Other

---

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so guest was updated.

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
    "message": "Invalid Wedding Plan Id. Wedding Plan does not exist."
}
```

```json
{
    "message": "Invalid email format."
}
```

```json
{
    "message": "Invalid guest name."
}
```

```json
{
    "message": "Invalid guest surname."
}
```

```json
{
    "message": "Invalid RSVP status. Use pending, accepted, or declined."
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
---

### <span class="json">500 Server Error</span>

The server failed to update the wedding plan task.

```json
{
    "message": "Server error."
}
``` 