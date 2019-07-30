---
description: >-
  Understand how each permission affects access for ProcessMaker users and
  groups.
---

# Permission Descriptions for Users and Groups

## Overview

In ProcessMaker, a permission allows a ProcessMaker user or group member to view a type of information or perform an action in ProcessMaker. Below are some examples of ProcessMaker permissions:

* Start Requests
* View the list of Processes
* Edit Processes
* Edit ProcessMaker Screens
* Create Environment Variables
* View Task Assignments through the ProcessMaker REST API

Permissions are organized into categories, such as for [Processes](permission-descriptions-for-users-and-groups.md#processes), [Requests](permission-descriptions-for-users-and-groups.md#requests), and [Screens](permission-descriptions-for-users-and-groups.md#screens).

### Assign Permissions to Users and Groups

While permissions apply to ProcessMaker users, those permissions can be assigned from a ProcessMaker user account or a ProcessMaker group:

* **User-level permissions:** Permissions can be assigned to a ProcessMaker user account. These permission assignments only apply to that user account. From user-level permissions, you can assign Administrator-level permissions or all permissions to a ProcessMaker user account. Instead of assigning individual permissions to a ProcessMaker user account, the following options are also available:

  * **Super Admin:** Assign the **Make this user a Super Admin** option to grant unrestricted access to the entire ProcessMaker instance. In doing so, ProcessMaker does not check permissions for ProcessMaker user accounts with this setting selected, allowing such users to administer and install [packages](../package-development-distribution/first-topic.md) which might otherwise require permissions be granted to a ProcessMaker user account to perform.
  * **All permissions:** Assign the **Assign all permissions to this user** option to assign all permissions to that ProcessMaker user account.

  See [Edit a User Account](add-users/manage-user-accounts/edit-a-user-account.md#edit-a-processmaker-user-account).

* **Group-level permissions:** Permissions can be assigned to a ProcessMaker group. A group assigns the same permissions to all ProcessMaker user account members. Using ProcessMaker groups makes it easy to manage permissions for multiple ProcessMaker user accounts with identical permission assignments. From group-level permissions, you can assign all permissions to a ProcessMaker group. See [Edit a Group](assign-groups-to-users/manage-groups/edit-a-group.md#edit-a-processmaker-group).

### User and Group Permissions are Cumulative

User-level and group-level permission assignments are cumulative. This means that a ProcessMaker user account has all the group-level permission assignments from all its group memberships, but also has the flexibility of permission assignments that apply only to that ProcessMaker user account. For example, a ProcessMaker user account might be a member of a group whereby its members can view the list of all Processes. However, a ProcessMaker Administrator can assign the permission to edit Processes to only the one ProcessMaker user account.

### Best Practice to Assign Permissions

ProcessMaker recommends [creating ProcessMaker groups](assign-groups-to-users/manage-groups/create-a-group.md#create-a-processmaker-group) based on how you define ProcessMaker usage roles in your organization. Based on usage roles you define, assign permissions to ProcessMaker groups so that all group members have the same permission set. Below is an example how you might create groups to assign permissions:

* **ProcessMaker user:** Most ProcessMaker users start or participate in Requests and perform [Tasks](../using-processmaker/task-management/what-is-a-task.md). Their permission assignments may be limited to [Requests](permission-descriptions-for-users-and-groups.md#requests). Note that if you want specific ProcessMaker users and/or groups to start and/or cancel Requests, those must be set from the following functional areas and are outside the scope of the permission settings discussed in this topic:
  * **Cancel Requests:** [Process Configuration](../designing-processes/viewing-processes/view-the-list-of-processes/edit-the-name-description-category-or-status-of-a-process.md#edit-configuration-information-about-a-process)
  * **Start Requests:** [Start Event element configuration](../designing-processes/process-design/model-your-process/add-and-configure-an-event-element.md#select-the-processmaker-user-or-group-that-can-start-requests)
* **Process Owner:** Process Owners create Process models. Their permission assignments may be limited to [Environment Variables](permission-descriptions-for-users-and-groups.md#environment-variables), Process [Categories](permission-descriptions-for-users-and-groups.md#categories), [Processes](permission-descriptions-for-users-and-groups.md#processes), [Requests](permission-descriptions-for-users-and-groups.md#requests), [Screens](permission-descriptions-for-users-and-groups.md#screens), and [Vocabularies](permission-descriptions-for-users-and-groups.md#vocabularies) categories.
* **ProcessMaker Developer:** ProcessMaker Developers create ProcessMaker [Scripts](../designing-processes/scripts/what-is-a-script.md). Their permission assignments may be limited to [Collections](permission-descriptions-for-users-and-groups.md#collections), [Files \(API\)](permission-descriptions-for-users-and-groups.md#files-api), [Notifications \(API\)](permission-descriptions-for-users-and-groups.md#notifications-api), [Requests](permission-descriptions-for-users-and-groups.md#requests), [Scripts](permission-descriptions-for-users-and-groups.md#scripts), and [Task Assignments \(API\)](permission-descriptions-for-users-and-groups.md#task-assignments-api) categories.
* **ProcessMaker Administrator:** ProcessMaker Administrators administer the ProcessMaker environment and its users. Their permission assignments may be limited to [Auth Clients](permission-descriptions-for-users-and-groups.md#auth-clients), [Collections](permission-descriptions-for-users-and-groups.md#collections), [Comments](permission-descriptions-for-users-and-groups.md#comments), [Groups](permission-descriptions-for-users-and-groups.md#groups), [Requests](permission-descriptions-for-users-and-groups.md#requests), and [Users](permission-descriptions-for-users-and-groups.md#users) categories. Assign specific ProcessMaker Administrators in their ProcessMaker user accounts the **Make this user a Super Admin** option.

## Permission Descriptions

Permissions are organized into categories. Permissions are described below by category and how each permission affects ProcessMaker functionality. These permissions function identically in ProcessMaker user accounts and groups.

### Auth Clients

The **Auth Clients** category contains the following permissions:

* **View Auth Clients:** View all client authentication keys on the **Auth Clients** page. See [View All Client Authentication Keys](auth-client-management/manage-client-authentications/view-all-client-authentication-keys.md).
* **Create Auth Clients:** Create a client authentication key on the **Auth Clients** page. Selecting this permission also selects the **Edit Auth Clients** permission. See [Create a New Client Authentication Key](auth-client-management/manage-client-authentications/create-a-new-client-authentication-key.md).
* **Edit Auth Clients:** Edit a client authentication key from the **Auth Clients** page. See [Edit a Client Authentication Key](auth-client-management/manage-client-authentications/edit-a-client-authentication-key.md).
* **Delete Auth Clients:** Delete a client authentication key from the **Auth Clients** page. See [Delete a Client Authentication Key](auth-client-management/manage-client-authentications/delete-a-client-authentication-key.md).

{% hint style="info" %}
Select the **View Auth Clients** permission to use any of the other permissions in this category.
{% endhint %}

### Categories

The **Categories** category contains the following permissions:

* **View Categories:** View the table of Process Categories on the **Categories** page. See [View Process Categories](../designing-processes/viewing-processes/process-categories.md#view-process-categories).
* **Create Categories:** Create a Process Category from the **Categories** page. Selecting this permission also selects the **Edit Categories** permission. See [Add a New Process Category](../designing-processes/viewing-processes/process-categories.md#add-a-new-process-category).
* **Edit Categories:** Edit a Process Category from the **Categories** page. See [Edit a Process Category](../designing-processes/viewing-processes/process-categories.md#edit-a-process-category).
* **Delete Categories:** Delete a Process Category from the **Categories** page. See [Delete a Process Category](../designing-processes/viewing-processes/process-categories.md#delete-a-process-category).

{% hint style="info" %}
Select the **View Categories** permission to use any of the other permissions in this category.
{% endhint %}

### Collections

{% hint style="info" %}
The [Collections package](../package-development-distribution/package-a-connector/collections.md) must be installed in your ProcessMaker instance for the **Collections** category of permissions to display. The Collections package is not available in the ProcessMaker open-source edition. Contact [ProcessMaker Sales](mailto:sales@processmaker.com) or ask your ProcessMaker sales representative how the Collections package can be installed in your ProcessMaker instance.
{% endhint %}

The **Collections** category contains the following permissions:

* **View Collections:** View the table of Collections on the **Collections** page. See ~~LINK~~.
* **Create Categories:** Create a Collection from the **Collections** page. Selecting this permission also selects the **Edit Collections** permission. See ~~LINK~~.
* **Edit Collections:** Edit a Collection from the **Collections** page. See ~~LINK~~.
* **Delete Collections:** Delete a Collection from the **Collections** page. See ~~LINK~~.

{% hint style="info" %}
Select the **View Collections** permission to use any of the other permissions in this category.
{% endhint %}

### Comments

The **Comments** category contains the following permissions:

* **View Comments:** View comments on a Request information page. See ~~LINK~~.
* **Create Comments:** Create a comment from a Request information page. Selecting this permission also selects the **Edit Comments** permission. See ~~LINK~~.
* **Edit Comments:** Edit a comment from a Request information page. See ~~LINK~~.
* **Delete Comments:** Delete a comment from a Request information page. See ~~LINK~~.

{% hint style="info" %}
Select the **View Comments** permission to use any of the other permissions in this category.
{% endhint %}

### Environment Variables

The **Environment Variables** category contains the following permissions:

* **View Environment Variables:** View the table of Environment Variables on the **Environment Variables** page. See [View All Environment Variables](../designing-processes/environment-variable-management/manage-your-environment-variables/view-all-environment-variables.md).
* **Create Environment Variables:** Create an Environment Variable from the **Environment Variables** page. Selecting this permission also selects the **Edit Environment Variables** permission. See [Create a New Environment Variable](../designing-processes/environment-variable-management/manage-your-environment-variables/create-a-new-environment-variable.md).
* **Edit Environment Variables:** Edit an Environment Variable from the **Environment Variables** page. See [Edit an Environmental Variable](../designing-processes/environment-variable-management/manage-your-environment-variables/edit-an-environmental-variable.md).
* **Delete Environment Variables:** Delete an Environment Variable from the **Environment Variables** page. See [Delete an Environment Variable](../designing-processes/environment-variable-management/manage-your-environment-variables/remove-an-environment-variable.md).

{% hint style="info" %}
Select the **View Environment Variables** permission to use any of the other permissions in this category.
{% endhint %}

### Files \(API\)

The **Files \(API\)** category contains the following permissions:

* **View Files:** Returns the list of files associated to an API request. See "Files &gt; Get" endpoint in the ProcessMaker REST API.
* **Create Files:** Saves a new file specified in an API request. Selecting this permission also selects the **Edit Files** permission. See "Files &gt; Post" endpoint in the ProcessMaker REST API.
* **Edit Files:** Update a file specified in an API request. See "Files &gt; Update" endpoint in the ProcessMaker REST API.
* **Delete Files:** Deletes a specified file in an API request. See "Files &gt; Delete" endpoint in the ProcessMaker REST API.

### Groups

The **Groups** category contains the following permissions:

* **View Groups:** View the table of ProcessMaker groups on the **Groups** page. See [View All Groups](assign-groups-to-users/manage-groups/view-all-groups.md).
* **Create Groups:** View a ProcessMaker group from the **Groups** page. Selecting this permission also selects the **Edit Groups** permission. See [Create a New Group](assign-groups-to-users/manage-groups/create-a-group.md).
* **Edit Groups:** Edit a ProcessMaker group from the **Groups** page. See [Edit a Group](assign-groups-to-users/manage-groups/edit-a-group.md).
* **Delete Groups:** Delete a ProcessMaker group from the **Groups** page. See [Delete a Group](assign-groups-to-users/manage-groups/remove-a-group.md).

{% hint style="info" %}
Select the **View Groups** permission to use any of the other permissions in this category.
{% endhint %}

### Notifications \(API\)

The **Notifications \(API\)** category contains the following permissions:

* **View Notifications:**  Returns all notifications to which the user has access. See "Notifications &gt; Get" endpoint in the ProcessMaker REST API.
* **Create Notifications:**  Save a new notification through an API request. Selecting this permission also selects the **Edit Notifications** permission. See "Notifications &gt; Post" endpoint in the ProcessMaker REST API.
* **Edit Notifications:** Updates a notification through an API request. See "Notifications &gt; Update" endpoint in the ProcessMaker REST API.
* **Delete Notifications:** Deletes a specified notification through an API request. See "Notifications &gt; Delete" endpoint in the ProcessMaker REST API.

### Processes

The **Processes** category contains the following permissions:

* **View Processes:** View the table of Processes on the **Processes** page. See [View All Processes](../designing-processes/viewing-processes/view-the-list-of-processes/view-your-processes.md).
* **Create Processes:** Create a Process from the **Processes** page. Selecting this permission also selects the **Edit Processes** permission. See [Create a New Process](../designing-processes/viewing-processes/view-the-list-of-processes/create-a-process.md).
* **Edit Processes:** Edit a Process model and/or its configuration from the **Processes** page. See [Edit a Process Model](../designing-processes/viewing-processes/view-the-list-of-processes/view-your-processes.md#edit-the-process-model) and [Edit Process Configuration](../designing-processes/viewing-processes/view-the-list-of-processes/edit-the-name-description-category-or-status-of-a-process.md).
* **Archive Processes:** Archive a Process from the **Processes** page. See [Archive a Process](../designing-processes/viewing-processes/view-the-list-of-processes/remove-a-process.md).
* **Import Processes:** Import a Process from the **Processes** page. See [Import a BPMN-Compliant Process](../designing-processes/viewing-processes/view-the-list-of-processes/import-a-bpmn-compliant-process.md).
* **Export Processes:** Export a Process from the **Processes** page. See [Export a BPMN-Compliant Process](../designing-processes/viewing-processes/view-the-list-of-processes/export-a-bpmn-compliant-process.md).

{% hint style="info" %}
Select the **View Processes** permission to use any of the other permissions in this category.
{% endhint %}

### Requests

The **Requests** category contains the following permission:

* **Edit Request Data:** View the **Data** tab for a completed Request and edit the [completed Request data](../using-processmaker/requests/request-details/#completed-tasks-summary) that is in JSON format. See [View a Request Summary](../using-processmaker/requests/request-details/#editable-request-data).
* **Edit Task Data:** View the **Data** tab for an assigned Task and edit the Task data that is in JSON format. See [View a Task Summary](../using-processmaker/task-management/view-a-task-summary.md#editable-task-data).
* **View All Requests:** View the **All Requests** page and [Request information](../using-processmaker/requests/request-details/) accessible from that page. See [View All Requests](../using-processmaker/requests/view-all-requests.md).

### Screens

The **Screens** category contains the following permissions:

* **View Screens:** View the table of ProcessMaker Screens on the **Screens** page. See [View All Screens](../designing-processes/design-forms/manage-forms/view-all-forms.md).
* **Create Screens:** Create a ProcessMaker Screen from the **Screens** page. Selecting this permission also selects the **Edit Screens** permission. See [Create a New Screen](../designing-processes/design-forms/manage-forms/create-a-new-form.md).
* **Edit Screens:** Edit a ProcessMaker Screen and/or its configuration from the **Screens** page. See [Edit a Screen](../designing-processes/design-forms/screens-builder/control-descriptions/) and [Edit Screen Configuration](../designing-processes/design-forms/manage-forms/edit-a-screen.md).
* **Delete Screens:** Delete a ProcessMaker Screen from the **Screens** page. See [Delete a Screen](../designing-processes/design-forms/manage-forms/remove-a-screen.md).
* **Import Screens:** Import a ProcessMaker Screen from the **Screens** page. See [Import a Screen](../designing-processes/design-forms/manage-forms/import-a-screen.md).
* **Export Screens:** Export a ProcessMaker Screen from the **Screens** page. See [Export a Screen](../designing-processes/design-forms/manage-forms/export-a-screen.md).

{% hint style="info" %}
Select the **View Screens** permission to use any of the other permissions in this category.
{% endhint %}

### Scripts

The **Scripts** category contains the following permissions:

* **View Scripts:** View the table of ProcessMaker Scripts on the **Scripts** page. See [View All Scripts](../designing-processes/scripts/manage-scripts/view-all-scripts.md).
* **Create Scripts:** Create a ProcessMaker Script from the **Scripts** page. Selecting this permission also selects the **Edit Scripts** permission. See [Create a New Script](../designing-processes/scripts/manage-scripts/create-a-new-script.md).
* **Edit Scripts:** Edit a ProcessMaker Script and/or its configuration from the **Scripts** page. See [Edit a Script](../designing-processes/scripts/manage-scripts/edit-a-script.md) and [Edit Script Configuration](../designing-processes/scripts/manage-scripts/edit-script-configuration.md).
* **Delete Scripts:** Delete a ProcessMaker Script from the **Scripts** page. See [Delete a Script](../designing-processes/scripts/manage-scripts/remove-a-script.md).

{% hint style="info" %}
Select the **View Scripts** permission to use any of the other permissions in this category.
{% endhint %}

### Task Assignments \(API\)

The **Task Assignments \(API\)** category contains the following permissions:

* **View Task Assignments:** Returns all assignments assigned to the user.
* **Create Task Assignments:** Saves a new task assignment to a specified user in an API request. Selecting this permission also selects the **Edit Task Assignments** permission.
* **Edit Task Assignments:** Updates a task assignment through an API request.
* **Delete Task Assignments:** Deletes a specified task assignment through an API request.

### Users

The **Users** category contains the following permissions:

* **View Users:** View the table of ProcessMaker user accounts on the **Users** page. See [View All Users Accounts](add-users/manage-user-accounts/view-all-users.md).
* **Create Users:** Create a ProcessMaker user account from the **Users** page. Selecting this permission also selects the **Edit Users** permission. See [Create a New User Account](add-users/manage-user-accounts/create-a-user-account.md).
* **Edit Users:** Edit a ProcessMaker user account from the **Users** page. See [Edit a User Account](add-users/manage-user-accounts/edit-a-user-account.md).
* **Delete Users:** Delete a ProcessMaker user account from the **Users** page. See [Delete a User Account](add-users/manage-user-accounts/remove-a-user-account.md).

{% hint style="info" %}
Select the **View Users** permission to use any of the other permissions in this category.
{% endhint %}

### Vocabularies

{% hint style="info" %}
The [Vocabularies package](../package-development-distribution/package-a-connector/vocabularies.md) must be installed in your ProcessMaker instance for the **Vocabularies** category of permissions to display. The Vocabularies package is not available in the ProcessMaker open-source edition. Contact [ProcessMaker Sales](mailto:sales@processmaker.com) or ask your ProcessMaker sales representative how the Vocabularies package can be installed in your ProcessMaker instance.
{% endhint %}

The **Vocabularies** category contains the following permissions:

* **View Vocabularies:** View the table of ProcessMaker Vocabularies on the **Vocabularies** page. See [View All Vocabularies](../designing-processes/vocabularies-management/manage-your-vocabularies/view-all-vocabularies.md).
* **Create Vocabularies:** Create a ProcessMaker Vocabulary from the **Vocabularies** page. Selecting this permission also selects the **Edit Vocabularies** permission. See [Create a New Vocabulary](../designing-processes/vocabularies-management/manage-your-vocabularies/create-a-new-vocabulary.md).
* **Edit Vocabularies:** Edit a ProcessMaker Vocabulary from the **Vocabularies** page. See [Edit a Vocabulary](../designing-processes/vocabularies-management/manage-your-vocabularies/edit-a-vocabulary.md).
* **Delete Vocabularies:** Delete a ProcessMaker Vocabulary from the **Vocabularies** page. See [Delete a Vocabulary](../designing-processes/vocabularies-management/manage-your-vocabularies/delete-a-vocabulary.md).

{% hint style="info" %}
Select the **View Vocabularies** permission to use any of the other permissions in this category.
{% endhint %}

## Related Topics

{% page-ref page="../using-processmaker/requests/what-is-a-request.md" %}

{% page-ref page="../using-processmaker/requests/view-all-requests.md" %}

{% page-ref page="../using-processmaker/requests/request-details/" %}

{% page-ref page="../designing-processes/scripts/manage-scripts/view-all-scripts.md" %}

{% page-ref page="../using-processmaker/task-management/view-a-task-summary.md" %}

{% page-ref page="../designing-processes/scripts/manage-scripts/create-a-new-script.md" %}

{% page-ref page="../designing-processes/scripts/manage-scripts/edit-script-configuration.md" %}

{% page-ref page="../designing-processes/scripts/manage-scripts/edit-a-script.md" %}

{% page-ref page="../designing-processes/scripts/manage-scripts/remove-a-script.md" %}

{% page-ref page="../designing-processes/viewing-processes/process-categories.md" %}

{% page-ref page="../designing-processes/design-forms/manage-forms/view-all-forms.md" %}

{% page-ref page="../designing-processes/design-forms/manage-forms/create-a-new-form.md" %}

{% page-ref page="../designing-processes/design-forms/manage-forms/edit-a-screen.md" %}

{% page-ref page="../designing-processes/design-forms/screens-builder/control-descriptions/" %}

{% page-ref page="../designing-processes/design-forms/manage-forms/remove-a-screen.md" %}

{% page-ref page="../designing-processes/environment-variable-management/manage-your-environment-variables/view-all-environment-variables.md" %}

{% page-ref page="../designing-processes/environment-variable-management/manage-your-environment-variables/create-a-new-environment-variable.md" %}

{% page-ref page="../designing-processes/environment-variable-management/manage-your-environment-variables/edit-an-environmental-variable.md" %}

{% page-ref page="../designing-processes/environment-variable-management/manage-your-environment-variables/remove-an-environment-variable.md" %}

{% page-ref page="add-users/manage-user-accounts/view-all-users.md" %}

{% page-ref page="add-users/manage-user-accounts/create-a-user-account.md" %}

{% page-ref page="add-users/manage-user-accounts/edit-a-user-account.md" %}

{% page-ref page="add-users/manage-user-accounts/remove-a-user-account.md" %}

{% page-ref page="assign-groups-to-users/manage-groups/view-all-groups.md" %}

{% page-ref page="assign-groups-to-users/manage-groups/create-a-group.md" %}

{% page-ref page="assign-groups-to-users/manage-groups/edit-a-group.md" %}

{% page-ref page="assign-groups-to-users/manage-groups/remove-a-group.md" %}

{% page-ref page="../designing-processes/viewing-processes/view-the-list-of-processes/view-your-processes.md" %}

{% page-ref page="../designing-processes/viewing-processes/view-the-list-of-processes/create-a-process.md" %}

{% page-ref page="../designing-processes/viewing-processes/view-the-list-of-processes/edit-the-name-description-category-or-status-of-a-process.md" %}

{% page-ref page="../designing-processes/viewing-processes/view-the-list-of-processes/import-a-bpmn-compliant-process.md" %}

{% page-ref page="../designing-processes/viewing-processes/view-the-list-of-processes/export-a-bpmn-compliant-process.md" %}

{% page-ref page="auth-client-management/manage-client-authentications/view-all-client-authentication-keys.md" %}

{% page-ref page="../designing-processes/vocabularies-management/what-is-a-vocabulary.md" %}

{% page-ref page="../designing-processes/vocabularies-management/manage-your-vocabularies/view-all-vocabularies.md" %}

{% page-ref page="../designing-processes/vocabularies-management/manage-your-vocabularies/create-a-new-vocabulary.md" %}

{% page-ref page="../designing-processes/vocabularies-management/manage-your-vocabularies/edit-a-vocabulary.md" %}

{% page-ref page="../designing-processes/vocabularies-management/manage-your-vocabularies/delete-a-vocabulary.md" %}

