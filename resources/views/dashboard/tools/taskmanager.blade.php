<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:300px 1fr;gap:1.5rem;">
<div>
<div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;margin-bottom:1rem;">// TASK.add()</div>
<div style="display:flex;flex-direction:column;gap:0.75rem;margin-bottom:1.25rem;">
<input type="text" id="tm-title" placeholder="Task title..." style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(0,255,136,0.15)'">
<select id="tm-proj" style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:rgba(0,255,136,0.7);font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;"><option>Acme Corp</option><option>Notion Redesign</option><option>Personal</option></select>
<div style="display:flex;gap:0.5rem;">
<select id="tm-pri" style="flex:1;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:rgba(0,255,136,0.7);font-family:'JetBrains Mono',monospace;font-size:0.7rem;padding:0.55rem 0.5rem;outline:none;cursor:pointer;"><option value="high">🔴 High</option><option value="med" selected>🟡 Medium</option><option value="low">🟢 Low</option></select>
<input type="date" id="tm-due" style="flex:1;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:rgba(0,255,136,0.7);font-family:'JetBrains Mono',monospace;font-size:0.7rem;padding:0.55rem 0.5rem;outline:none;">
</div>
<button onclick="addTask()" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.7rem;border:none;cursor:pointer;">+ Add Task</button>
</div>
<div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:1rem;">
<div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.12em;margin-bottom:0.75rem;">PROJECTS</div>
<div id="tm-proj-stats"></div>
</div>
</div>
<div>
<div style="display:flex;gap:0.5rem;margin-bottom:1rem;">
<button onclick="filterTasks('all')" class="tm-filter font-mono" style="font-size:0.6rem;padding:0.3rem 0.75rem;background:#00ff88;color:#000;border:none;cursor:pointer;letter-spacing:0.1em;">ALL</button>
<button onclick="filterTasks('todo')" class="tm-filter font-mono" style="font-size:0.6rem;padding:0.3rem 0.75rem;background:transparent;color:rgba(255,255,255,0.3);border:1px solid rgba(255,255,255,0.08);cursor:pointer;">TODO</button>
<button onclick="filterTasks('in-progress')" class="tm-filter font-mono" style="font-size:0.6rem;padding:0.3rem 0.75rem;background:transparent;color:rgba(255,255,255,0.3);border:1px solid rgba(255,255,255,0.08);cursor:pointer;">IN PROGRESS</button>
<button onclick="filterTasks('done')" class="tm-filter font-mono" style="font-size:0.6rem;padding:0.3rem 0.75rem;background:transparent;color:rgba(255,255,255,0.3);border:1px solid rgba(255,255,255,0.08);cursor:pointer;">DONE</button>
</div>
<div id="tm-list" style="display:flex;flex-direction:column;gap:0.5rem;"></div>
<div id="tm-empty" style="text-align:center;padding:3rem;font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:rgba(255,255,255,0.15);">No tasks yet. Add your first task →</div>
</div>
</div>
</div>
<script>
let tasks=[
{id:1,title:"Finalize homepage design",proj:"Acme Corp",pri:"high",due:"2026-03-10",status:"in-progress"},
{id:2,title:"Write API documentation",proj:"Notion Redesign",pri:"med",due:"2026-03-12",status:"todo"},
{id:3,title:"Client kickoff call prep",proj:"Acme Corp",pri:"high",due:"2026-03-05",status:"done"},
{id:4,title:"Update invoice template",proj:"Personal",pri:"low",due:"2026-03-15",status:"todo"},
];
let nextId=5,filter="all";
const priColors={high:"#ef4444",med:"#f59e0b",low:"#00ff88"};
const statusOpts=["todo","in-progress","done"];

function renderTasks(){
const list=document.getElementById("tm-list");
const empty=document.getElementById("tm-empty");
const filtered=filter==="all"?tasks:tasks.filter(t=>t.status===filter);
list.innerHTML="";
if(!filtered.length){empty.style.display="block";return;}
empty.style.display="none";
filtered.forEach(t=>{
const div=document.createElement("div");
div.style.cssText="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:0.875rem 1rem;display:flex;align-items:center;gap:0.75rem;animation:fadeIn 0.2s ease;";
div.innerHTML=`<span style="width:8px;height:8px;border-radius:50%;background:${priColors[t.pri]||"#fff"};flex-shrink:0;"></span><div style="flex:1;"><div style="font-size:0.78rem;color:rgba(255,255,255,${t.status==="done"?"0.3":"0.7"});${t.status==="done"?"text-decoration:line-through;":""}font-weight:500;">${t.title}</div><div style="font-family:monospace;font-size:0.58rem;color:rgba(255,255,255,0.2);margin-top:0.2rem;">${t.proj} · Due: ${t.due}</div></div><select onchange="changeStatus(${t.id},this.value)" style="background:#0a1520;border:1px solid rgba(255,255,255,0.08);color:rgba(255,255,255,0.4);font-family:monospace;font-size:0.58rem;padding:0.2rem 0.4rem;outline:none;cursor:pointer;">${statusOpts.map(s=>`<option value="${s}" ${s===t.status?"selected":""}>${s}</option>`).join("")}</select><button onclick="deleteTask(${t.id})" style="font-family:monospace;font-size:0.62rem;color:rgba(239,68,68,0.4);background:transparent;border:none;cursor:pointer;padding:0.2rem 0.4rem;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='rgba(239,68,68,0.4)'">✕</button>`;
list.appendChild(div);
});
renderProjects();
}

function renderProjects(){
const projs={};
tasks.forEach(t=>{if(!projs[t.proj])projs[t.proj]={total:0,done:0};projs[t.proj].total++;if(t.status==="done")projs[t.proj].done++;});
document.getElementById("tm-proj-stats").innerHTML=Object.entries(projs).map(([name,d])=>`<div style="margin-bottom:0.5rem;"><div style="display:flex;justify-content:space-between;margin-bottom:0.2rem;"><span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.4);">${name}</span><span class="font-mono" style="font-size:0.58rem;color:rgba(0,255,136,0.6);">${d.done}/${d.total}</span></div><div style="height:3px;background:rgba(255,255,255,0.05);"><div style="height:100%;width:${d.total?Math.round(d.done/d.total*100):0}%;background:#00ff88;"></div></div></div>`).join("");
}

function addTask(){
const title=document.getElementById("tm-title").value.trim();
if(!title)return;
tasks.unshift({id:nextId++,title,proj:document.getElementById("tm-proj").value,pri:document.getElementById("tm-pri").value,due:document.getElementById("tm-due").value||"—",status:"todo"});
document.getElementById("tm-title").value="";
renderTasks();
}
function changeStatus(id,status){const t=tasks.find(t=>t.id===id);if(t)t.status=status;renderTasks();}
function deleteTask(id){tasks=tasks.filter(t=>t.id!==id);renderTasks();}
function filterTasks(f){filter=f;document.querySelectorAll(".tm-filter").forEach(b=>{b.style.background="transparent";b.style.color="rgba(255,255,255,0.3)";b.style.border="1px solid rgba(255,255,255,0.08)";});event.target.style.background="#00ff88";event.target.style.color="#000";event.target.style.border="none";renderTasks();}
document.getElementById("tm-due").value=new Date(Date.now()+7*864e5).toISOString().split("T")[0];
renderTasks();
</script>
<style>@keyframes fadeIn{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}</style>
