# (MODX)EvolutionCMS.plugins.ManagerManager.mm_ddMultipleFields changelog


## Версия 4.8.1 (2020-05-25)
* \* Улучшена уникальность идентификатора строки, когда он используется для обратной совместимости.
* \* `jQuery.ddMM.mm_ddMultipleFields.init`: Исправлено использование устаревшей колонки `id`.


## Версия 4.8 (2020-05-25)
* \* Колонка `richtext`: Символы `<`, `>` и `&` больше не заменяются на HTML сущности (`&lt;`, `&gt;` и `&amp;` соответственно).
* \* Значение в TV хранится в виде объекта JSON, никаких больше строк через разделители (с обратной совместимостью).
* \+ Виджет всегда генерирует уникальный ID для каждой строки и сохраняет его в виде ключа результирующего объекта (см. README).
* \* Параметры → `$params->columns[i]['type']`: Значение `'id'` объявлено устаревшим и больше не используется (с обратной совместимостью).
* \* Настоятельно рекомендуется использовать (MODX)EvolutionCMS.snippets.ddGetMultipleField >= 3.5 для вывода TV на сайте.
* \+ Пустые строки (объекты строк с путыми значениями колонок) не будут сохранены.
* \+ README.
* \+ README_ru.
* \+ CHANGELOG.
* \+ CHANGELOG_ru.
* \+ Composer.json.


## Версия 4.7.4 (2019-06-23)
* \* Новый адрес (MODX)EvolutionCMS.libraries.ddTools для совместимости с новой версией ManagerManager.


## Версия 4.7.3 (2018-11-22)
* \* Стиль: Улучшена ширина input.
* \* Используется метод `$modx->getConfig` вместо прямого обращения к свойству `$modx->config`.
* \* Всплывающее поле полнотекстового редактора (_Большое спасибо, [@MrSwed](https://github.com/MrSwed)._):
	* \+ Автовокус в textarea.
	* \* Окно теперь без внутреннего скролла.
	* \* Корректный размер окна и элементов.


## Версия 4.7.2 (2018-03-29)
* \* `jQuery.ddMM.mm_ddMultipleFields`:
	* \* Датапикер получает конфиг из конфига CMS.
	* \* `makeSelect`: Ширина поля устанавливается из параметра.


## Версия 4.7.1 (2017-05-03)
* \* Полнотекстовый редактор используется из `$modx->config['which_editor']`. _Большое спасибо, [@MrSwed](https://github.com/MrSwed)._
* \* Поле полнотекстового редактора во всплывающем окне работает корректно даже если Tiny MCE не установлен.


## Версия 4.7 (2016-11-19)
* \* Внимание! Требуется PHP >= 5.4.
* \* Внимание! Требуется (MODX)EvolutionCMS.plugins.ManagerManager >= 0.7.
* \* Используется короткий синтаксис массивов PHP, потому что это удобнее.
* \* Рефакторинг, виджет теперь использует именованные параметры (обратная совместимость сохранена).
* \* Рефакторинг: `jQuery.ddMM.fields` используется вместо ручного поиска DOM.
* \* `jQuery.ddMM.mm_ddMultipleFields`:
	* \* Рефакторинг, плагин использует именованные параметры.
	* \* Рефакторинг `jQuery.ddMM.mm_ddMultipleFields.instances`:
		* \* Элементы добавляются через `jQuery.ddMM.mm_ddMultipleFields.init`.
		* \* `currentField` переименовано в `$currentField`.
		* \+ `$parent`, `$originalField` и `$table` добавлены.
* \* Параметр `$params->columns` должен быть массивом. Элементы содержат тип, заголовок, ширину и данные. Параметры `$params->columnsTitles`, `$params->columnsWidth` и `$params->columnsData` объявлены устаревшими. Конечно, обратная совместимость сохранена.
* \+ Кнопка добавления вставляется в каждую строку (closes #7).
* \* Небольшие изменения стиля.


## Версия 4.6 (2014-10-24)
* \* Внимание! Требуется (MODX)EvolutionCMS.plugins.ManagerManager >= 0.6.3.
* \* Имейте ввиду, следует использовать `image` и / или `file` в типах колонак вместо `field` (обратная совместимость сохранена).
* \* Переменная `$dir` переименована в `$richtextIncludeDirectory` из-за конфликтов в пространствах имён.
* \* Все TV, к которым применён виджет, должны быть типа `textarea` (обратная совместимость сохранена, но строго рекомендуется поменять тип).
* \* `$.ddMM.mm_ddMultipleFields` обновлён до 1.2:
	* \* Следует использовать `image` и / или `file` в типах колонак вместо `field`.
	* \- Параметры `makeFieldFunction` и `browseFuntion` удалены за ненадобостью.
	* \- Метод `maskQuoutes` Удалён. Кавычки сейчас конвертируются в HTML-сущности.
	* \* Значения инпутам устанавливаются через `$.fn.val`.
	* \* По необходимости добавлена инициализация следующих функций: `OpenServerBrowser`, `BrowseServer`, `BrowseFileServer`, `SetUrlChange`, `SetUrl` (копии оригинальных из ядра MODX).
	* \* Изменние `SetUrl` выполянется только для старых версий MODX (если функция `SetUrlChange` отсутствует).


## Версия 4.5.1 (2014-05-15)
* \* `jQuery.fn.mm_ddMultipleFields` обновлён до 1.0.1:
	* \* Добавлено отключение событий плагина (MODX)EvolutionCMS.plugins.ManagerManager.mm_widget_showimagetvs.
* \* `richtext/index.php`:
	* \* ран лишний слэш при подключении системных файлов.
	* \* Файл `manager/includes/protect.inc.php` подключается перед подключением `manager/includes/config.inc.php`.
	* \* Вместо константы `MODX_MANAGER_PATH` для подключения необходимых файлов испольузется относительный путь и константа `MGR_DIR` (полезно, в случае, если сайт лежит не в `$_SERVER['DOCUMENT_ROOT']`).


## Версия 4.5 (2013-12-10)
* \* Внимание! Требуется (MODX)EvolutionCMS.plugins.ManagerManager >= 0.6.
* \+ Добавлен новый тип колонок `richtext` (см. параметр `$coloumns`).
* \+ Добавлена поддержка TV типов `textarea` и `email`.
* \* Один вызов функции `tplUseTvs` с передачей необходимых для получения полей вместо трёх.
* \* JS и CSS подключаются через функцию `includeJsCss` (что позволяет совсем не беспокоиться о дубликатах).
* \* JS-код вынесен в отдельный файл и частично переработан. Мало того, что это просто удобно (ничего лишнего в PHP), это ещё и сокращает объём исходного кода формы редактирования документа, исключая дубликаты при множественных вызовах.
* \* Подключение необходимых JS и CSS вынесено в отдельное событие `OnDocFormPrerender`, файлы сейчас подключаются в обычном HTML-виде, а не через JS.
* \* При разборе данных `$columnsData` спецсимволы экранируются в любом случае (а не только при `eval`).
* \* При создании колонки типа `id` title предаётся как `''`, а ширина как `0` (т.к. всё равно ничего этого не нужно).
* \* При обработке заголовков колонок учитываются колонки типа `id`.


## Версия 4.4.2 (2013-07-02)
* \* Шаблон текущего документа больше не вычисляется, просто берётся из переменной `$mm_current_page['template']` (раньше иногда возникали проблемы).


## Версия 4.4.1 (2013-06-18)
* \* Исправлена ошибка с кнопкой добавления строки в инициализации виджета.


## Версия 4.4b (2013-05-20)
* \+ Добавлены новые типы колонок: `textarea` и `date` (см. параметр `$coloumns`).
* \* В параметр `$coloumnsTitle` теперь можно передавать меньше заголовков, чем колонок (недостающие будут пустыми).
* \* jQuery-UI удалён из папки виджета за ненадобностью (т.к. в MM 0.5 он лежит в `/assets/plugins/managermanager/js/`, как и сам jQuery).
* \* Небольшая оптимизация под свежий jQuery.
* \* Обновление значения оригинального поля теперь происходит не каждый раз при изменении любого значения в любой колонке, а только при сохранении документа (немного сэкономили на производительности и упростили себе жизнь).
* \* Немного упрощёно визуальное оформление виджета.
* \* При достижении максимального количества строк кнопочка `+` становится визуально неактивной.
* \* Исправлены ошибки в названиях параметров.
* \* Прочие небольшие изменения кода во имя оптимизации и рефакторинга.


## Версия 4.3.4 (2012-12-20)
* \* Исправлена ошибка при использовании минимального количества строк. Массив наполнялся значениями `undefined`, в результате чего попытка использования метода `replace` приводила к ошибке.


## Версия 4.3.3 (2012-09-17)
* \* Исправлена ошибка при использовании типа поля `id`. При очистке последнего значения `id` удалялся и заново не генерировался.


## Версия 4.3.2 (2012-05-04)
* \* Исправлена ошибка с преждевременной инициализацией (событие `change.ddEvents`) поля с изображением.
* \* Небольшие изменения в коде.


<link rel="stylesheet" type="text/css" href="https://DivanDesign.ru/assets/files/ddMarkdown.css" />
<style>ul{list-style:none;}</style>