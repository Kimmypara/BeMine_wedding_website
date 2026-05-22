# Get Single Wedding Plan

Get a single wedding plan by wedding_plan_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/wedding_plan/readSingle.php?wedding_plan_id=4</span>

---

## Description

This endpoint returns a single wedding plan from the database using the provided wedding_plan_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "wedding_plan_id": "4",
    "user_id": 2,
    "user_nickname": "Kitty",
    "partner_nickname": "Mike",
    "wedding_date": "2028-01-03",
    "guest_count": 300,
    "budget": "100000.50"
}
```

---
### <span class="json">400 Bad request</span>

The wedding_plan_id is missing.

```json
{
    "message": "Missing Wedding Plan ID."
}
```
---
### <span class="json">404 Not Found</span>

No wedding plan was found with the provided wedding_plan_id.

```json
{
    "message": "Wedding Plan not found."
}
```