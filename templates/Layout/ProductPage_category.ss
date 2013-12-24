<h2>$Title</h2>
$Content
<div class="pc-first-column">
<% include Categories %>
</div>
<div class="pc-second-column">
    <ul class="pc-box pc-products">
        <% loop Products  %>
            <li>
                <a href="$Top.Link$Link">$getThumbnail</a><br/>
                <a href="$Top.Link$Link">$Title</a>
            </li>
        <% end_loop %>
    </ul>
</div>    
</div>