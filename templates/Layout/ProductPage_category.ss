<h2>$Title</h2>
$Content
<div id="left">
<% include Categories %>
</div>
<div id="right">
<div class="categories">
    <% loop Products %>
        <div class="row">
            <div class="column">$Title</div>
            <div class="column">$InternalItemId</div>
            <div class="column">$Model</div>
            <div class="column">$Manufacturer</div>
            <div class="column">$Price</div>
        </div>
    <% end_loop %>
</div>
</div>    
</div>