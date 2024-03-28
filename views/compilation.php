<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: left;
            }
        </style>
    </head>
    
    
    <body>

    
        <table>
          
            <thead>
            	<tr>
              		<th colspan="3">Income: </th>                 
            	</tr>


       			<tr>
 	           		<?php if (! empty($tableHead)): ?>
  							<?php foreach ($tableHead as $tableHeadItem ): ?>
  	      
             		   	 <th> <?= $tableHeadItem   ?> </th>
   
            
             			<?php endforeach ?>
           	  <?php endif ?>
             
     		  </tr>
           		         
            </thead>
            
            
            <tbody>

                <?php if (! empty($incomeTable)): ?>
  						<?php foreach ($incomeTable as $income ): ?>
           <tr>
                  <?php if (! empty($income)): ?>
  						<?php foreach ($income as $cat ): ?>
      		     
          		      <td><?= $cat ?></td>
    	   	      
             	<?php endforeach ?>
   			  <?php endif ?>
		
           </tr> 			   		
      
             	<?php endforeach ?>
             <?php endif ?>
           		         
            </tbody>
                     

        </table>
        
        
        
        
       <table>
            <thead>
           	 <tr>
                 <th colspan="3">Expense: </th>  
               
             </tr>


      		 <tr>
 	               <?php if (! empty($tableHead)): ?>
  							<?php foreach ($tableHead as $tableHeadItem ): ?>
  						
 
             		     <th> <?= $tableHeadItem   ?> </th>
     
        	  	   	<?php endforeach ?>
         	    <?php endif ?>
             
      		 </tr>
           		         
            </thead>
            
            
            
            <tbody>

                <?php if (! empty($expenseTable)): ?>
  						<?php foreach ($expenseTable as $expense ): ?>
           <tr>
                  <?php if (! empty($expense)): ?>
  						<?php foreach ($expense as $cat ): ?>
      		     
          		      <td><?= $cat ?></td>
      			   	      
             	<?php endforeach ?>
   			  <?php endif ?>
		
             </tr> 			   		
      
             	<?php endforeach ?>
             <?php endif ?>
           		         
            </tbody>
            <tfoot>
            
               <tr>
               	<th colspan="3">Opening Balance: </th>  
               	<td><?= formatDollarAmount($totals['inSaldo']  ?? 0) ?> </td>      
               </tr>
            
               <tr>
               	<th colspan="3">Total Income: </th>  
               	<td><?= formatDollarAmount($totals['totalIncome']  ?? 0) ?> </td>      
               </tr>
					<tr>
               	<th colspan="3">Total Expense: </th>  
               	<td><?= formatDollarAmount($totals['totalExpense']  ?? 0) ?> </td>                	 
               </tr>
               <tr>
               	<th colspan="3">Net Total: </th>  
               	<td><?= formatDollarAmount($totals['netTotal']  ?? 0) ?> </td>                	 
               </tr>
 
      


            </tfoot>
        </table>
        
        
        
    </body>
</html>
