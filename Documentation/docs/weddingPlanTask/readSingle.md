# Get Single Wedding Plan Task

Get a single wedding plan task by wedding_plan_task_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/wedding_plan_task/readSingle.php?wedding_plan_task_id=222</span>

---

## Description

This endpoint returns a single wedding plan task from the database using the provided wedding_plan_task_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "wedding_plan_task_id": "222",
    "wedding_plan_id": 17,
    "task_id": null,
    "is_selected": 1,
    "is_completed": 1,
    "category_id": 9
}
```

---
### <span class="json">400 Bad request</span>

The wedding_plan_task_id is missing.

```json
{
    "message": "Missing Wedding Plan Task ID."
}
```
---
### <span class="json">404 Not Found</span>

No wedding plan task was found with the provided wedding_plan_task_id.

```json
{
    "message": "Wedding Plan Task not found."
}
```