<script>
    $(document).ready(function () {
        $('label.tree-toggler').click(function () {
            $(this).parent().children('ul.tree').toggle(300);
        });
    });
</script>
<div class="well" style="width:300px; padding: 8px 0;">
    <div style="overflow-y: scroll; overflow-x: hidden; height: 500px;">
        <ul class="nav nav-list">
            <li><label class="tree-toggler nav-header">Header 1</label>
                <ul class="nav nav-list tree">
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><label class="tree-toggler nav-header">Header 1.1</label>
                        <ul class="nav nav-list tree">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><label class="tree-toggler nav-header">Header 1.1.1</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="divider"></li>
            <li><label class="tree-toggler nav-header">Header 2</label>
                <ul class="nav nav-list tree">
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><label class="tree-toggler nav-header">Header 2.1</label>
                        <ul class="nav nav-list tree">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><label class="tree-toggler nav-header">Header 2.1.1</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><label class="tree-toggler nav-header">Header 2.2</label>
                        <ul class="nav nav-list tree">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><label class="tree-toggler nav-header">Header 2.2.1</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>