# Get Single Task 

Get a single Task by task_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/readSingle.php?task_id=3</span>

---

## Description

This endpoint returns a single Task from the database using the provided task_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "task_id": "3",
    "task_name": "booking",
    "category_id": 1
}
```

---
### <span class="json">400 Bad request</span>

The task_id is missing.

```json
{
    "message": "Missing task_id."
}
```
---
### <span class="json">404 Not Found</span>

No task was found with the provided task_id.

```json
{
    "message": "No tasks found."
}
```