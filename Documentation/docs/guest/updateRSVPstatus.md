# Update RSVP Status

Update the RSVP Status.

## Request Body

```json
{
    "guest_id":"5",
    "rsvp_status":"accepted"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/guest/updateRSVPStatus.php</span>

### Body <span class="json">application/json</span>

<span class="box">guest_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The guest_id must be existing.  

<span class="box">rsvp_status</span>
<span class="endpoint-box">ENUM</span>
<span class="endpoint-box">Required</span>

Chice between pending, accepted or declined. Pending is the default option.  


## Responses

### <span class="json">200 OK Updated</span>

The request worked, so RSVP status was updated.

```json
{
    "message": "RSVP status updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "RSVP status not updated. Missing or invalid input."
}
```

Possible Validation errors:

```json
{
    "message": "Invalid Guest Id. Guest does not exist."
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
    "message": "RSVP status not updated. This status is already set."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the RSVP status.

```json
{
    "message": "Server error."
}
``` 