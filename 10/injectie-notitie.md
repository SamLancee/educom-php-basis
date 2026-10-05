1. Dit is gevaarlijk omdat de database niet het verschil weet tussen een normale query en input van een user
als er dus geldige sql wordt meegestuurd wordt dit gewoon uitgevoerd. Dit is dus heel gevoelig voor hackers
2. het filter kan makkelijk omzeilt worden. Een simpele 1 ==1 toevoeging zorgt hier al voor. 
3. Bij de prepare regelt wat er allemaal vast in de database staat. Bij de execute worden dus alleen pure data verzonden. 