
<div class="table-responsive">


	<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">已投票用户</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">未投票用户</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content ballot-list">
    <div role="tabpanel" class="tab-pane active" id="home">

	{loop $data['voteduser'] $username}
    <span>{$username}</span>
    {/loop}
	</div>

    <div role="tabpanel" class="tab-pane" id="profile">

	{loop $data['unvoteuser'] $username}
    <span>{$username}</span>
    {/loop}
	
	</div>
  </div>


	</div>