<h2>$Title</h2>
$Content
<div class="pc-first-column">
<% include Categories %>
</div>
<div class="pc-second-column">
    <div class="pc-box pc-product">
        <% loop Product %>
            <div class="pc-product-photo">
                $getPhotoForTemplate
            </div>
            <div class="pc-product-show">
                <h2><%t Product.TITLE "Title" %> : $Title</h2>
                <% if InternalItemId %>
                <p><b><%t Product.INTERNALITEMID "Item Id" %></b> : $InternalItemId</p>
                <% end_if %>
                <% if Model %>
                    <p><b><%t Product.MODEL "Model" %></b> : $Model</p>
                <% end_if %>
                <% if Manufacturer %>
                    <p><b><%t Product.MANUFACTURER "Manufacturer" %></b> : $Manufacturer</p>
                <% end_if %>
                <% if Price %>
                    <p><b><%t Product.PRICE "Price" %></b> : $Price</p>
                <% end_if %>
                <% if Description %>
                    <p>$Description</p>
                <% end_if %>
            </div>
        <% end_loop %>
    </div>
</div>