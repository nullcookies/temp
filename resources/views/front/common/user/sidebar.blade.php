<aside class="col-left sidebar">
      <div class="block block-tags">
        <div class="block-title"> My Account</div>
          <div class="block-content block-content-my">
            <div class="user-imgbox">
              <img src="{{asset('images/user_male.png')}}"/>
            </div>
            <div class="user-detailbox">
              <h4>{{substr(Auth::user()->name,0,20)}}</h4>
              <h6>{{Auth::user()->email}}</h6>
            </div>            
          </div>
          <!-- <div class="block-content info-block">
            <p>You might be logged in on other devices.<br/>
            To signout from all devices <a href="javascript:;">Click Here</a></p>
          </div> -->
        </div>  
            <div class="side-nav-categories">
              <div class="block-title-blue"> Orders </div>
              <!--block-title--> 
              <!-- BEGIN BOX-CATEGORY -->
              <div class="box-content box-category">
                                <ul>
                  <li> <a class="active" href="javascript:;">Orders</a> <span class="subDropdown minus"></span>
                    <ul class="level0_415" style="display:block">
                      <li> <a href="{{url('/user/orders')}}"> My Orders </a><!--level1--> </li>
                      <!--level1-->               
                    </ul>
                    <!--level0--> 
                  </li>
                  
                </ul>
              </div>
              <!--box-content box-category--> 
            </div>
      <!-- <div class="side-nav-categories">
              <div class="block-title"> Profile </div>
              <div class="box-content box-category">
                  <ul>
                  <li> <a class="active" href="javascript:;">Profile</a> <span class="subDropdown minus"></span>
                    <ul class="level0_415" style="display:block">
                      <li> <a href="javascript:;"> Personal Details </a> </li>
                      <li> <a href="javascript:;"> Edit Profile </a></li>
                      <li> <a href="{{url('/user/addresses')}}"> Saved Addresses </a></li>
                      <li> <a href="{{url('/user/changePassword')}}"> Change Password</a></li>              
                    </ul>
                  </li>
                </ul>
              </div>
            </div> -->
          </aside>