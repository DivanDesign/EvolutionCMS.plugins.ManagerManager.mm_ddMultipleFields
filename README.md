# (MODX)EvolutionCMS.plugins.ManagerManager.mm_ddMultipleFields

Widget for plugin ManagerManager that allows you to add any number of fields values (TV) in one document (values are written in field as a JSON object). For example: a few images.

Capabilities:
* Save several images, text fields, selects, etc to a document field.
* Create several columns with different (or identical) data types. For example: images with titles (`$params->columns`).
* Number of rows may be fixed, dynamic or may lay in the special range (`$params->minRowsNumber`, `$params->maxRowsNumber`).
* Rows sorting by drag and drop.
* Generating of an unique ID for each row.
* List of predefined values for a column (`$params->columns[i]['type']` == `'select'`).


## Requires

* PHP >= 5.4
* [(MODX)EvolutionCMS.plugins.ManagerManager](https://code.divandesign.biz/modx/managermanager) >= 0.7


## Documentation


### Installation

To install you must unzip the archive to `/assets/plungins/managermanager/widgets/`.


You may also read this documentation:
* [(MODX)EvolutionCMS.plugins.ManagerManager](https://code.divandesign.biz/modx/managermanager).
* [(MODX)EvolutionCMS.modules.ddMMEditor](https://code.divandesign.biz/modx/ddmmeditor).
* [(MODX)EvolutionCMS.snippets.ddGetMultipleField](https://code.divandesign.biz/modx/ddgetmultiplefield).


Type of TV must be `textarea`.


### Parameters description

* `$params`
	* Desctription: Parameters, the pass-by-name style is used.
	* Valid values:
		* `stdClass`
		* `arrayAssociative`
	* **Required**
	
* `$params->fields`
	* Desctription: Names of TV for which the widget is applying.
	* Valid values: `stringCommaSeparated`
	* **Required**
	
* `$params->columns`
	* Desctription: Columns.
	* Valid values: `array`
	* Default value: `[ ['type' => 'text'] ]`
	
* `$params->columns[i]`
	* Desctription: Column.
	* Valid values: `arrayAssociative`
	* **Required**
	
* `$params->columns[i]['type']`
	* Desctription: Column type.
	* Valid values:
		* `'text'` — `<input type="text">` column
		* `'textarea'` — `<textarea>` column
		* `'richtext'` — column with rich text editor
		* `'image'` — image column
		* `'file'` — file column
		* `'date'` — date column
		* `'select'` — `<select>` column (see `$params->columns[i]['data']`)
	* **Required**
	
* `$params->columns[i]['title']`
	* Desctription: Column title.
	* Valid values: `string`
	* Default value: `''`
	
* `$params->columns[i]['width']`
	* Desctription: Column width, px.
	* Valid values: `integer`
	* Default value: `180`
	
* `$params->columns[i]['data']`
	* Desctription: Valid values (for the `'select'` column type)
	* Valid values: `stringJsonArray`
	* Default value: —
	
* `$params->columns[i]['data'][i]`
	* Desctription: Item.
	* Valid values: `arrayAssociative`
	* **Required**
	
* `$params->columns[i]['data'][i]['value']`
	* Desctription: Item value.
	* Valid values: `string`
	* **Required**
	
* `$params->columns[i]['data'][i]['title']`
	* Desctription: Item title.
	* Valid values: `string`
	* Default value: == `$params->columns[i]['data'][i]['value']`
	
* `$params->minRowsNumber`
	* Desctription: Minimum number of rows.
	* Valid values: `integer`
	* Default value: `0`
	
* `$params->maxRowsNumber`
	* Desctription: Maximum number of rows.
	* Valid values:
		* `integer`
		* `0` — unlimited
	* Default value: `0`
	
* `$params->previewWidth`
	* Desctription: Maximum value of image preview width (for the `'image'` columns).
	* Valid values: `integer`
	* Default value: `300`
	
* `$params->previewHeight`
	* Desctription: Maximum value of image preview height (for the `'image'` columns).
	* Valid values: `integer`
	* Default value: `100`
	
* `$params->roles`
	* Desctription: The CMS user roles that the widget is applied to.
	* Valid values:
		* `stringCommaSeparated`
		* `''` — when this parameter is empty then widget is applied to the all roles
	* Default value: `''`
	
* `$params->roles[i]`
	* Desctription: CMS user role.
	* Valid values: `integer`
	* **Required**
	
* `$params->templates`
	* Desctription: Document templates IDs for which the widget is applying to.
	* Valid values:
		* `stringCommaSeparated`
		* `''` — empty value means the widget is applying to all templates
	* Default value: `''`
	
* `$params->templates[i]`
	* Desctription: Templates ID.
	* Valid values: `integer`
	* **Required**


### CMS events

* `OnDocFormPrerender`
* `OnDocFormRender`


### Output format

The widget save value to a TV as JSON object with the following structure:

```json
{
	"1590412453247": {
		"0": "First row, first column value",
		"1": "First row, second column value"
	},
	"1590412497589": {
		"0": "Second row, first column value",
		"1": "Second row, Second column value"
	}
}
```

Where:
* `1590412453247`, `1590412497589` — the unique auto generated row IDs (JS `(new Date).getTime()` is used while creating rows).
* `0`, `1` — column numbers.

Rows objects with empty column values will not be saved.

It is strongly recommend to use [(MODX)EvolutionCMS.snippets.ddGetMultipleField](https://code.divandesign.biz/modx/ddgetmultiplefield) >= 3.5 for rendering TVs on site.


### Examples


#### Make the TV `someImages` available for adding several number of images

Create the TV `someImages`, set it's type equal to `textarea`.

```php
mm_ddMultipleFields([
	'fields' => 'someImages',
	'columns' => [
		//Only one column
		[
			'type' => 'image'
		]
	]
]);
```


#### Create 2 columns: images with titles

```php
mm_ddMultipleFields([
	'fields' => 'someImage',
	'columns' => [
		[
			'type' => 'image',
			'title' => 'Photo'
		],
		[
			'type' => 'text',
			'title' => 'Title'
		]
	]
]);
```


#### Table of employees contacts

Create the TV `employees`, set it's type equal to `textarea`.

```php
mm_ddMultipleFields([
	'fields' => 'employees',
	'columns' => [
		[
			'type' => 'text',
			'title' => 'Name',
			'width' => 250
		],
		[
			'type' => 'text',
			'title' => 'Phone'
			'width' => 100
		],
		[
			'type' => 'text',
			'title' => 'Job title'
			'width' => 200
		]
	],
	//Minimum 2 employee is required
	'minRowsNumber' => 2,
	//And maximum 10
	'maxRowsNumber' => 10
]);
```


#### `<select>` column type

```php
mm_ddMultipleFields([
	'fields' => 'employees',
	'columns' => [
		[
			'type' => 'text',
			'title' => 'Name',
			'width' => 250
		],
		[
			'type' => 'text',
			'title' => 'Phone'
			'width' => 100
		],
		[
			'type' => 'select',
			'title' => 'Job title'
			'data' => '[
				{
					"value": "Founder"
				},
				{
					"value": "SEO"
				},
				{
					"value": "Designer"
				},
				{
					"value": "Product manager"
				},
				{
					"value": "Developer"
				}
			]'
		]
	]
]);
```


## Links

* [Home page](https://code.divandesign.biz/modx/mm_ddmultiplefields)
* [Telegram chat](https://t.me/dd_code)


<link rel="stylesheet" type="text/css" href="https://DivanDesign.ru/assets/files/ddMarkdown.css" />