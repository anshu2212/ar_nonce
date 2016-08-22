# ar_nonce
This is not exactly a "Number Used Once". Neither a number Nor can be Just Used Once.  But can Reduce the Repitive Attachs by Decreasing the Window of attach 


To apply to your project 
<ol>
<li>include the class in all your file that needs to generate nonce or verify nonce. Eg. <pre>&lt;?php include(PATH TO ar_nonce.class.php ); ?&gt;</pre></li>
<li>Then create new instance of class <pre>&lt?php $nonce=new ar_Nonce();  ?&gt</pre></li>
<li>To attach a nonce we have 3 methods.
  <ol>
    <li>To attach in Form : <pre>&lt;?php echo $nonce->generate_form_nonce(string $action , [ string $user ] , [ bool $output=false ]); ?&gt;</pre></li>
    <li>To attach in Url :<pre>&lt;?php echo $nonce->generate_url_nonce( string $action,[ string $user],[bool $out=false ]); ?&gt; </pre></li>
    <li>To other purposes  :<pre>&lt;?php echo $nonce->generate( string $action ,[string $user] , [ int $timeoutSeconds , [ string $secretKey ]); ?&gt; </pre></li>
  </ol>
</li>
<li >To verify a nonce :
  <pre>&lt;?php $nonce->check(string $nonce , string $action , [ string $user ], [ string $secret]) ?&gt;</pre>
</ol>
