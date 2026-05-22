# Create Wedding Plan 

Create a new Wedding Plan for the couple.  

## Request Body

```json
{
    "user_id": "20",
    "user_nickname":"Kim",
    "partner_nickname": "Tim",
    "wedding_date": "2027/01/02",
    "guest_count": "300",
    "budget":"60000"
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/wedding_plan/create.php</span>

### Body <span class="json">application/json</span>

<span class="box">user_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The user_id must be existing. 

<span class="box">user_nickname</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Nickname of user does not have to be unique. 

<span class="box">partner_nickname</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Partner Nickname does not have to be unique.

<span class="box">wedding_date</span>
<span class="endpoint-box">Date</span>
<span class="endpoint-box">Required</span>

The date format should be:
```
 "yyyy/mm/dd"

```
<span class="box">guest_count</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The guest count must be whole number. 

<span class="box">budget</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The budget can be a decimal number.

## Responses

### <span class="json">201 Created</span>

The request worked, so a new Wedding Plan was created.

```json
{
    "message": "Wedding Plan created."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Wedding Plan not created. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "Guest count must be a valid whole number."
}
```

```json
{
    "message": "Budget must be a valid number."
}
```
---

### <span class="json">409 Conflict</span>

The Wedding Plan already exists.

``````json
{
    "message": "Wedding Plan not created. Wedding Plan already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to create the Wedding Plan.

```json
{
    "message": "Server error."
}
``` 