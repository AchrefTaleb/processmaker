---
description: >-
  Develop and test your ProcessMaker Script in a secure and isolated
  environment.
---

# Scripts Editor

## Overview

{% hint style="info" %}
Your user account or group membership must have the following permissions to create or edit a ProcessMaker Script:

* Scripts: View Scripts
* Scripts: Create Scripts
* Scripts: Edit Scripts

See the ProcessMaker [Scripts](../../processmaker-administration/permission-descriptions-for-users-and-groups.md#scripts) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Use Scripts Editor to develop and test your ProcessMaker Scripts. Any ProcessMaker Script can be used in any Process in your organization. Scripts Editor supports Lua and PHP languages in the open-source release.

Scripts Editor evaluates a ProcessMaker Script securely and in isolation. This ensures that any malicious script that anyone in your organization might inadvertently introduce to ProcessMaker does not affect the ProcessMaker application or its environment.

ProcessMaker Scripts are developed and tested in the same environment.

{% hint style="info" %}
Access Scripts Editor in the following ways:

* [Create a new ProcessMaker Script.](manage-scripts/create-a-new-script.md#create-a-new-processmaker-script)
* [Edit an existing ProcessMaker Script.](manage-scripts/edit-a-script.md#edit-a-processmaker-script)
{% endhint %}

Below is Scripts Editor displaying a ProcessMaker Script written in PHP.

![Scripts Editor](../../.gitbook/assets/scripts-editor-processes.png)

## Scripts Editor Usage Guidelines

Follow these guidelines to develop and test ProcessMaker Scripts in Scripts Editor.

### Develop Your ProcessMaker Script

Develop the ProcessMaker Script below the script's name and language description. Use the scroll panel to navigate to script not currently displayed. This is useful especially when you are editing a long ProcessMaker Script.

### Mock Request Data Coming Into the ProcessMaker Script

Use the **Sample Input** panel to mock [Request](../../using-processmaker/requests/what-is-a-request.md) data that comes into the ProcessMaker Script.

{% hint style="info" %}
Define the variables in a [ProcessMaker Screen](../design-forms/what-is-a-form.md) in the **Inspector** panel when you configure its controls. See [View the Inspector Panel](../design-forms/screens-builder/view-the-inspector-pane.md). Also, see [information about each control](../design-forms/screens-builder/control-descriptions/).
{% endhint %}

Follow these guidelines to mock Request data coming into your ProcessMaker Script:

1. [Open the ProcessMaker Screen](../design-forms/manage-forms/edit-a-screen.md) in which to view its JSON data model.
2. Enter [Preview mode](../design-forms/screens-builder/preview-a-screen.md) on the ProcessMaker Screen page to view its JSON data model. Click the **Preview** button from Screen Builder's top menu to enter Preview mode.
3. Enter values into the control fields as if you were using the ProcessMaker Screen in a Request. In the **Data Preview** section of the **Inspector** panel, the JSON data model displays the key-value pairs. The keys' values are those you enter in the ProcessMaker Screen preview.  Understand what the key names are. Each key is derived from a ProcessMaker Screen control's **Variable Name** value. Use these key names as variables in your ProcessMaker Script.

   The JSON data model within a ProcessMaker Screen becomes the variables in any [Task element](../process-design/model-your-process/add-and-configure-task-elements.md#select-the-processmaker-screen-for-a-task-element) of a Process model that uses that Screen. Use these variables to capture what Request participants enter into a ProcessMaker Screen as input data to a ProcessMaker Script.

4. After you have entered values into the ProcessMaker Script in Preview mode, the entire JSON data model displays in the **Data Preview** panel. Copy the JSON data model.
5. Paste the JSON data model into the **Sample Input** panel in Scripts Editor. If you use any variables as defined in the JSON data model in your ProcessMaker Script, Scripts Editor uses those variable values during script testing.

### Enter Other JSON Data as Input to Your ProcessMaker Script

Use the **Configuration** panel to include JSON configuration settings your ProcessMaker Script might access. For example, include the Client ID and Client Secret values in JSON format for OAuth 2.0 verification to a third-party service's API your ProcessMaker Script must access to access the API. By entering these values into the **Configuration** panel, you can verify during testing that these values are valid for the third-party service.

### Test Your ProcessMaker Script

Click the **Run** button to test your ProcessMaker Script. Scripts Editor evaluates any JSON data entered into the **Configuration** and **Sample Input** panels.

If the ProcessMaker Script evaluates successfully, its output displays in the **Output** panel. If the ProcessMaker Script does not evaluate successfully, the language engine evaluating the script displays an error.

### Save Your ProcessMaker Script

Click the **Save** icon![](../../.gitbook/assets/save-icon-processes.png)from Script Editor's top menu to save the ProcessMaker Script.

## Related Topics

{% page-ref page="what-is-a-script.md" %}

{% page-ref page="manage-scripts/view-all-scripts.md" %}

{% page-ref page="manage-scripts/create-a-new-script.md" %}

{% page-ref page="manage-scripts/search-for-a-script.md" %}

{% page-ref page="manage-scripts/edit-script-configuration.md" %}

{% page-ref page="manage-scripts/edit-a-script.md" %}

{% page-ref page="manage-scripts/duplicate-a-script.md" %}

{% page-ref page="manage-scripts/remove-a-script.md" %}

{% page-ref page="../../using-processmaker/requests/what-is-a-request.md" %}

{% page-ref page="../process-design/model-your-process/add-and-configure-task-elements.md" %}

