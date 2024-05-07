<!DOCTYPE html>
<html lang="en">

<head>
    @include("$moduleName.templates.header")
</head>

<body>
    @yield('contentuser')
    @yield('detail')
    @include("$moduleName.elements.footer")
    @include("$moduleName.elements.script")
</body>

</html>
