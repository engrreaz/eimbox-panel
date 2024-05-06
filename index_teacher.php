<style>


.card {
    box-shadow: 0 0.46875rem 2.1875rem rgba(4,9,20,0.03), 0 0.9375rem 1.40625rem rgba(4,9,20,0.03), 0 0.25rem 0.53125rem rgba(4,9,20,0.05), 0 0.125rem 0.1875rem rgba(4,9,20,0.03);
    border-width: 0;
    transition: all .2s;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: var(--lighter);
    background-clip: border-box;
    border: 1px solid rgba(26,54,126,0.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
}
.vertical-timeline {
    width: 100%;
    position: relative;
    padding: 1.5rem 0 1rem;
}

.vertical-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 8px;
    height: 100%;
    width: 4px;
    background: var(--light);
    border-radius: .25rem;
}

.vertical-timeline-element {
    position: relative;
    margin: 0 0 1rem;
}

.vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
    visibility: visible;
    animation: cd-bounce-1 .8s;
}
.vertical-timeline-element-icon {
    position: absolute;
    top: 0;
    left: 1px;
}

.vertical-timeline-element-icon .badge-dot-xl {

}

.badge-dot-xl {
    width: 18px;
    height: 18px;
    position: relative;
}
.badge:empty {
    display: none;
}


.badge-dot-xl::before {
    content: '';
    width: 12px;
    height: 12px;
    border-radius: 50%;
    position: absolute;
    left: 50%;
    top: 50%;
    margin: -5px 0 0 -5px;
    background: #f00;
}

.vertical-timeline-element-content {
    position: relative;
    margin-left: 25px;
    font-size: .8rem;
}

.vertical-timeline-element-content .timeline-title {
    font-size: .8rem;
    text-transform: uppercase;
    margin: 0 0 .5rem;
    padding: 2px 0 0;
    font-weight: bold;
}

.vertical-timeline-element-content .vertical-timeline-element-date {
    display: block;
    position: absolute;
    left: -90px;
    top: 0;
    padding-right: 10px;
    text-align: right;
    color: #adb5bd;
    font-size: .7619rem;
    white-space: nowrap;
}

.vertical-timeline-element-content:after {
    content: "";
    display: table;
    clear: both;
}
</style>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0&appId=1531960230662845&autoLogAppEvents=1" nonce="PQ3ztUgg"></script>

 
        
        <div class="card mt-3">
            <div class="card-body">
                <b><center><?php echo $scname;?></center></b>
            </div>
        </div>
        
        
        
        <div class="card mt-3" onclick="gor();">
            <div class="card-body">
                <h4>Result</h4>
                <small><span style="font-style:italic;">View/Process Result for Half Yearly Examination  2023</span></small>
            </div>
        </div>


        <div class="main-card mb-3 card mt-3">
            <div class="card-header"><b>Notice</b></div>
            <div class="card-body">
                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                    <div class="vertical-timeline-item vertical-timeline-element">
                        <div>
                            <span class="vertical-timeline-element-icon bounce-in">
                                <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                            </span>
                            <span class="vertical-timeline-element-icon bounce-in">
                                <i class="badge badge-dot badge-dot-xl badge-success"></i>
                            </span>
                            <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">Half-Yearly Examination 2023</h4>
                                <p>Starts from Wednesday, 07 June, 2023<a href="javascript:void(0);" data-abc="true"></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">Facebook Page</div>
            <div class="card-body" style="padding:0;">
                
            </div>
            <div class="card-footer">Footer</div>
        </div>
        
        <div class="card mt-3" style="display:none;">
            <div class="card-header">Header</div>
            <div class="card-body">Content</div>
            <div class="card-footer">Footer</div>
        </div>
      
      
      
      <div style="height:60px;"></div>
      
      
      <script>
          function gor(){ window.location.href = 'resultprocess.php';}
          function student(){ window.location.href = 'classsection.php';}
      </script>
      
      
        <?php include 'footer.php';




