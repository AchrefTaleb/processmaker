---
description: Understand what a Script does in ProcessMaker.
---

# What is a Script?

## Overview

In ProcessMaker, Scripts allow Process Owners and ProcessMaker Developers to write self-contained programmatic actions that can be called from any Process at run-time. The same ProcessMaker Script can be deployed in any Process model. In other words, "write once, use anywhere."

While writing a ProcessMaker Script, test it before you deploy it. ProcessMaker Scripts are tested within the authoring environment to ensure they function as intended. While testing, do the following:

* Use the JSON data model that you can [preview from your ProcessMaker Screens](../design-forms/screens-builder/preview-a-screen.md) to ensure that variables designed from a ProcessMaker Screen function as intended in your ProcessMaker Script.
* [Incorporate other JSON-formatted data](scripts-editor.md#enter-other-json-data-as-input-to-your-processmaker-script), such as API keys, to ensure your ProcessMaker Script uses them correctly during your testing.

During run-time, ProcessMaker Scripts run within isolated containers for greater security. After the ProcessMaker Script runs and returns output to the Request, the container that isolated and ran the script automatically removes itself.

ProcessMaker supports Lua, PHP, and NodeJS programming languages in the open-source edition.

## Related Topics

{% page-ref page="what-is-a-script.md" %}

{% page-ref page="manage-scripts/create-a-new-script.md" %}

{% page-ref page="manage-scripts/search-for-a-script.md" %}

{% page-ref page="manage-scripts/edit-a-script.md" %}

{% page-ref page="manage-scripts/edit-script-configuration.md" %}

{% page-ref page="manage-scripts/duplicate-a-script.md" %}

{% page-ref page="manage-scripts/remove-a-script.md" %}

{% page-ref page="scripts-editor.md" %}

