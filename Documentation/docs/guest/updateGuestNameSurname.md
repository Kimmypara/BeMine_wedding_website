# Update Guest Name and Surname

Update the Guest name and surname.

## Request Body

```json
{
    "guest_id":"3",
    "guest_name":"Kevin",
    "guest_surname":"Hili"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/guest/updateGuestNameSurname.php</span>

### Body <span class="json">application/json</span>

<span class="box">guest_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The guest_id must be existing.  

<span class="box">guest_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Guest name does not have to be unique. 

<span class="box">guest_surname</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Guest surname does not have to be unique.

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so Guest Name and surname was updated.

```json
{
    "message": "Guest Name and Surname updated."
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
    "message": "Invalid guest name."
}
```

```json
{
    "message": "Invalid guest surname."
}
```
--- 

### <span class="json">404 Not Found</span>

The Guest Id does not exists.

```json
{
    "message": "Guest name and surname are not updated sine Guest Id does not exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the Guest name and surname.

```json
{
    "message": "Server error."
}
``` 