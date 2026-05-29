# Create Guest

Create a new Guest for the couple.  

## Request Body

```json
{
    "wedding_plan_id":"17",
    "guest_email":"jbonnici@gmail.com",
    "guest_name":"Jane",
    "guest_surname":"Borg",
    "rsvp_status":"pending",
    "guest_category":"Family of the Bride"
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/guest/create.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_id must be existing.  

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

## Responses

### <span class="json">201 Created</span>

The request worked, so a new Guest was created.

```json
{
    "message": "Guest created."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Guest not created. Missing or invalid input."
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
    "message": "Guest not created. E-mail already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to create the Guest.

```json
{
    "message": "Server error."
}
``` 