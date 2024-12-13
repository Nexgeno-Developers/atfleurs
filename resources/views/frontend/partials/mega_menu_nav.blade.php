<div id="overlay" onclick="closeNav()"></div>
<div class="sidenav" id="mySidenav">
  <div id="closeBtn" onclick="closeNav()">&times;</div>
  <div class="sidenavHeader">
    <i class="fas fa-user"></i> At Fleurs
  </div>
  
  <!--Below sidenavHeader-->
  @php $mainCategories = DB::table('categories')->where('level', 0)->where('order_level', 'asc')->get(); @endphp
  
  <div id="main-container">
      <div class="sidenavContentHeader">Shop By Category</div>
  @foreach($mainCategories as $category)
    @php $subCategories = DB::table('categories')->where('parent_id', $category->id)->get(); @endphp
    
    @if($subCategories->count() == 0) <!--No subcategory-->
        <a href="{{ route('products.category', $category->slug) }}">
          <div class="sidenavContent">{{ ucfirst($category->name) }}</div>
        </a>        
    @else <!--Have subcategory-->
        <a href="#" onclick="openSubCategory('{{$category->id}}')">
          <div class="sidenavRow">
            <div>{{ ucfirst($category->name) }}</div>
            <i class="fas fa-chevron-right" style="color: #8e9090;"></i>
          </div>
        </a>        
        <div class="subcategories_of_{{$category->id}}" style="display:none;">
            <div class="sidenavContentHeader">
                {{$category->name}}
            </div>
            @foreach($subCategories as $subCategory)
                <a href="{{ route('products.category', $subCategory->slug) }}"><div class="sidenavContent">{{$subCategory->name}}</div></a>   
            @endforeach
        </div>
    @endif
  @endforeach

    <hr />
    <div class="sidenavContentHeader">Quick Links</div>
    <a href="/about-us">
      <div class="sidenavContent">About At fleurs</div>
    </a>
    <a href="/services">
      <div class="sidenavContent">Services</div>
    </a>
    <a href="/careers">
      <div class="sidenavContent">Careers</div>
    </a>
    <a href="/blog">
      <div class="sidenavContent">Blog</div>
    </a>
    <a href="/contact-us">
      <div class="sidenavContent">Contact Us</div>
    </a>
    <div style="height: 50px"></div>  
  
  </div>
  
  <!--End of first container-->
  <div id="sub-container">
    <div id="mainMenu">
      <i class="las la-arrow-left"></i> Back Menu
    </div>
    <hr />
    <div id="sub-container-content">

    </div>
  </div>
</div>
<!--No sideNav-->
<div onclick="openNav()" class="menu_icons menu-360">   <img src="{{ static_asset('assets/img/nav_menu_icons.svg ') }}" /> </div>
<div id="whole-flex">
    
</div>

<script>
  //for navigation//

  function openNav() {
    document.getElementById("mySidenav").style.width = "";
    document.getElementById("mySidenav").style.animation = "expand 0.3s forwards";
    document.getElementById("mySidenav").style.display = "block";
    // closeBtn
    document.getElementById("closeBtn").style.display = "block";
    document.getElementById("closeBtn").style.animation = "show 0.3s";
    // overlay
    document.getElementById("overlay").style.display = "block";
    document.getElementById("overlay").style.animation = "show 0.3s";
    
    document.getElementById("overlay").style.display = "block";    
  }

  function closeNav() {
    document.getElementById("mySidenav").style.animation = "collapse 0.3s forwards";
    // closeBtn
    document.getElementById("closeBtn").style.animation = "hide 0.3s";
    // overlay
    document.getElementById("overlay").style.animation = "hide 0.3s";

    setTimeout(() => {
      document.getElementById("mySidenav").style.display = "none";
      document.getElementById("closeBtn").style.display = "none";
      document.getElementById("overlay").style.display = "none";
      // Reset Menus
      document.getElementById("main-container").style.animation = "";
      document.getElementById("main-container").style.transform = "translateX(0px)";
      document.getElementById("sub-container").style.animation = "";
      document.getElementById("sub-container").style.transform = "translateX(-380px)";
    }, 300);

    setTimeout(() => {
      document.getElementById("mySidenav").style.display = "none";
    }, 600);
    
    document.getElementById("overlay").style.display = "none";    
  }

  document.querySelectorAll(".sidenavRow").forEach(row => {
    row.addEventListener("click", () => {
      document.getElementById("main-container").style.animation = "mainAway 0.3s forwards";
      document.getElementById("sub-container").style.animation = "subBack 0.3s forwards";
    });
  });

  document.getElementById("mainMenu").addEventListener("click", () => {
    document.getElementById("main-container").style.animation = "mainBack 0.3s forwards";
    document.getElementById("sub-container").style.animation = "subPush 0.3s forwards";
  })
  
  function openSubCategory(category_id){
      var subCategoryList = $('.subcategories_of_'+category_id).html();
      $('#sub-container-content').html(subCategoryList);
  }
</script>