# Update Partner Nickname 

Update Partner Nickname.

## Request Body

```json
{
    "wedding_plan_id":"4",
    "partner_nickname":"Kirk"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/wedding_plan/updatePartnerNickname.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_id must be existing.  

<span class="box">partner_nickname</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Partner Nickname does not have to be unique.


## Responses

### <span class="json">200 OK Updated</span>

The request worked, so Partner Nickname was updated.

```json
{
    "message": "Partner Nickname from Wedding Plan updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Wedding Plan not updated. Missing or invalid input."
}
```


### <span class="json">404 Not Found</span>

The wedding_plan_id is not found.

```json
{
    "message": "Wedding plan Id does not exist."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the user.

```json
{
    "message": "Server error."
}
``` 